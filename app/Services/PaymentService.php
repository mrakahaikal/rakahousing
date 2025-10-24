<?php

namespace App\Services;

use App\Models\Installment;
use App\Models\MortgageRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PaymentService
{
    protected MidtransService $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    /**
     * @throws \Exception
     */
    public function createPayment(MortgageRequest|Collection $mortgageRequest): string
    {
        $sub_total_amount = $mortgageRequest->monthly_amount;
        $insurance = 900000;
        $total_tax_amount = round($sub_total_amount * 0.11);
        //        Business logic for calculating the total payment
        $grossAmount = round($sub_total_amount + $insurance + $total_tax_amount);

        //        Prepare transaction parameters for Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-'.uniqid(),
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone,
            ],
            'item_details' => [
                [
                    'id' => $mortgageRequest->id,
                    'price' => $grossAmount,
                    'quantity' => 1,
                    'name' => "Mortgage Payment for {$mortgageRequest->house->name}",
                ],
            ],
            'custom_field1' => Auth::id(),
            'custom_field2' => $mortgageRequest->id,
        ];

        //        Delegate Snap Token creation to Midtrans Service
        return $this->midtransService->createSnapToken($params);
    }

    public function processNotification()
    {
        $notification = $this->midtransService->handleNotification();

        $transactionStatus = $notification['transaction_status'];
        $grossAmount = $notification['gross_amount'];

        //        Ensure system only process the settled payment
        if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
            //            Extract custom fields to identify mortgage request
            $mortgageRequestId = $notification['custom_field2'];

            $mortgageRequest = MortgageRequest::findOrFail($mortgageRequestId);

            //            Create installment record
            $this->createInstallment($mortgageRequest, $grossAmount);
        }
    }

    private function createInstallment(MortgageRequest $mortgageRequest, int|float $grossAmount): void
    {
        $lastInstallment = $mortgageRequest->installments()
            ->where('is_paid', true)
            ->orderBy('no_of_payment', 'desc')
            ->first();

        $previousRemainingLoan = $lastInstallment
            ? $lastInstallment->remaining_loan_amount
            : $mortgageRequest->loan_interest_total_amount;

        $sub_total_amount = $mortgageRequest->monthly_amount;
        $insurance = 900000;
        $total_tax_amount = round($sub_total_amount * 0.11);

        $remainingLoan = max($previousRemainingLoan - $sub_total_amount, 0);

        Installment::create([
            'mortgage_request_id' => $mortgageRequest->id,
            'no_of_payment' => $mortgageRequest->installments->count() + 1,
            'total_tax_amount' => $total_tax_amount,
            'sub_total_amount' => $sub_total_amount,
            'grand_total_amount' => $grossAmount,
            'insurance_amount' => $insurance,
            'proof' => null,
            'is_paid' => true,
            'payment_type' => 'Midtrans',
            'remaining_loan_amount' => $remainingLoan,
        ]);
    }
}
