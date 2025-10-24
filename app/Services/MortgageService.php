<?php

namespace App\Services;

use App\Enums\MortgageStatus;
use App\Models\House;
use App\Models\Installment;
use App\Models\Interest;
use App\Models\MortgageRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MortgageService
{
    /**
     * Handle house interest request made by Users before creating mortgage request
     */
    public function handleInterestRequest(Request $request): mixed
    {
        $validatedData = $request->validate([
            'dp_percentage' => 'required|integer|min:0|max:100',
            'interest_id' => 'required|integer|exists:interests,id',
            'documents' => 'required|file|mimes:pdf|max:2048',
        ]);

        $interest = Interest::findOrFail($validatedData['interest_id'])->with('house');
        $house = $interest->house;

        $mortgageDetails = $this->calculateMortgageDetails($house, $interest, $validatedData['dp_percentage']);

        $documentPath = $this->uploadDocument($request);

        return $this->createMortgageRequest($mortgageDetails, $documentPath);
    }

    /**
     * Calculate mortgage details
     */
    public function calculateMortgageDetails(House|Model $house, Interest|Model $interest, int|float $dpPercentage): array
    {
        $housePrice = $house->price;
        $dpTotalAmount = $housePrice * ($dpPercentage / 100);
        $loanTotalAmount = $housePrice - $dpTotalAmount;
        $durationYears = $interest->duration;
        $totalPayments = $durationYears * 12; // total number of monthly payments
        $monthlyInterestRate = $interest->interest / 100 / 12; // monthly interest rate

        // amortization formula for monthly payment
        $numerator = $loanTotalAmount * $monthlyInterestRate * pow(1 + $monthlyInterestRate, $totalPayments);
        $denominator = pow(1 + $monthlyInterestRate, $totalPayments) - 1;
        $monthlyAmount = $denominator > 0 ? $numerator / $denominator : 0;

        $loanInterestTotalAmount = $monthlyAmount * $totalPayments;

        return compact(
            'house',
            'interest',
            'dpTotalAmount',
            'dpPercentage',
            'loanTotalAmount',
            'monthlyAmount',
            'loanInterestTotalAmount',
        );
    }

    /**
     * Upload users' document
     */
    public function uploadDocument(Request $request): string|null|false
    {
        return $request->hasFile('documents') ? $request->file('documents')->store('documents', 'public') : null;
    }

    /**
     * Create new mortgage request then save it to the session using interest ID as its session identifier
     */
    public function createMortgageRequest(array $mortgageDetails, string $documentPath): mixed
    {
        $mortgageRequest = MortgageRequest::create([
            'user_id' => Auth::id(),
            'house_id' => $mortgageDetails['house_id'],
            'interest_id' => $mortgageDetails['interest']->id,
            'duration' => $mortgageDetails['interest']->duration,
            'bank_name' => $mortgageDetails['interest']->bank->name,
            'interest' => $mortgageDetails['interest']->interest,
            'dp_total_amount' => $mortgageDetails['dpTotalAmount'],
            'loan_total_amount' => $mortgageDetails['loanTotalAmount'],
            'monthly_amount' => $mortgageDetails['monthlyAmount'],
            'dp_percentage' => $mortgageDetails['dpPercentage'],
            'status' => MortgageStatus::Pending,
            'documents' => $documentPath,
            'house_price' => $mortgageDetails['housePrice'],
            'loan_interest_total_amount' => $mortgageDetails['loanInterestTotalAmount'],
        ]);

        session(['interest_id' => $mortgageDetails['interest']->id]);

        return $mortgageRequest;
    }

    /**
     * Get created interest information from session
     */
    public function getInterestFromSession(): ?Interest
    {
        $interestId = session('interest_id');

        return $interestId ? Interest::findOrFail($interestId) : null;
    }

    /**
     * Get User(s)' Mortgages
     */
    public function getUserMortgages(User|int $userId): Collection
    {
        return MortgageRequest::with(['house', 'house.city', 'house.category'])
            ->where('user_id', $userId)
            ->get();
    }

    /**
     * Get user's mortgage details
     */
    public function getMortgageDetails(MortgageRequest $mortgageRequest): array
    {
        $mortgageRequest->load(['house.city', 'house.category', 'installments']);
        $monthlyPayment = $mortgageRequest->monthly_amount;
        $insurance = 900000;
        $totalTaxAmount = round($monthlyPayment * 0.11);

        return compact(
            'mortgageRequest',
            'totalTaxAmount',
            'insurance',
        );
    }

    /**
     * get user's Installment details
     */
    public function getInstallmentDetails(Installment $installment): Installment
    {
        return $installment->load(['mortgageRequest.house.city']);
    }

    /**
     * Get user's installment payment details
     */
    public function getInstallmentPaymentDetails(MortgageRequest $mortgageRequest): array
    {
        $remainingLoanAmount = $mortgageRequest->remaining_loan_amount;
        $mortgageRequest->load(['house.city', 'house.category', 'installments']);
        $monthlyPayment = $mortgageRequest->monthly_amount;
        $insurance = 900000;
        $totalTaxAmount = round($monthlyPayment * 0.11);
        $grandTotalAmount = $monthlyPayment + $insurance + $totalTaxAmount;
        $remainingLoanAmountAfterPayment = $remainingLoanAmount - $monthlyPayment;

        return compact(
            'mortgageRequest',
            'grandTotalAmount',
            'monthlyPayment',
            'totalTaxAmount',
            'insurance',
            'remainingLoanAmount',
            'remainingLoanAmountAfterPayment',
        );
    }

    public function getMortgageRequest(int $mortgageRequestId): Collection
    {
        return MortgageRequest::findOrFail($mortgageRequestId);
    }
}
