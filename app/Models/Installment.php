<?php

namespace App\Models;

use App\Traits\HasCurrencyFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read string $formattedTotalTaxAmount
 * @property-read string $formattedSubTotalAmount
 * @property-read string $formattedGrandTotalAmount
 * @property-read string $formattedInsuranceAmount
 * @property-read string $formattedRemainingLoanAmount
 */
class Installment extends Model
{
    use SoftDeletes, HasCurrencyFormatter;

    protected $fillable = [
        'mortgage_request_id',
        'no_of_payment',
        'total_tax_amount',
        'sub_total_amount',
        'grand_total_amount',
        'insurance_amount',
        'proof',
        'is_paid',
        'payment_type',
        'remaining_loan_amount',
    ];

    protected array $currencyColumns = [
        'total_tax_amount',
        'sub_total_amount',
        'grand_total_amount',
        'insurance_amount',
        'remaining_loan_amount'
    ];

    public function mortgageRequest(): BelongsTo
    {
        return $this->belongsTo(MortgageRequest::class);
    }
}
