<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Models\MortgageRequest;
use App\Services\MortgageService;
use App\Services\PaymentService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected MortgageService $mortgageService;
    protected PaymentService $paymentService;

    public function __construct(MortgageService $mortgageService, PaymentService $paymentService)
    {
        $this->mortgageService = $mortgageService;
        $this->paymentService = $paymentService;
    }

    public function index(): View
    {
        $userId = auth()->user()->id;
        $mortgages = $this->mortgageService->getUserMortgages($userId);

        return view('customer.mortgages.index', compact('mortgages'));
    }

    public function details(MortgageRequest $mortgageRequest): View
    {
        $details = $this->mortgageService->getMortgageDetails($mortgageRequest);

        return view('customer.mortgages.details', $details);
    }

    public function installmentDetails(Installment $installment): View
    {
        $installmentDetails = $this->mortgageService->getInstallmentDetails($installment);

        return view('customer.installments.index', compact('installmentDetails'));
    }

    public function installmentPayment(MortgageRequest $mortgageRequest): View
    {
        $paymentDetails = $this->mortgageService->getInstallmentPaymentDetails($mortgageRequest);

        return view('customer.installments.payment', compact('paymentDetails'));
    }

    public function paymentStoreMidtrans(Request $request): JsonResponse
    {
        try {
            $mortgageRequest = $this->mortgageService->getMortgageRequest($request->input['mortgage_request_id']);

            $snapToken = $this->paymentService->createPayment($mortgageRequest);

            return response()->json(['snap_token' => $snapToken], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => "Payment failed: {$e->getMessage()}"], 500);
        }
    }

    public function paymentMidtransNotification(Request $request): JsonResponse
    {
        try {
            $this->paymentService->processNotification();

            return response()->json(['payment_status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => "Failed to process notification: {$e->getMessage()}"], 500);
        }
    }
}
