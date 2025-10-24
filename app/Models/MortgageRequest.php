<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MortgageRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'house_id',
        'interest_id',
        'duration',
        'bank_name',
        'interest',
        'dp_total_amount',
        'loan_total_amount',
        'monthly_amount',
        'dp_percentage',
        'status',
        'documents',
        'house_price',
        'loan_interest_total_amount',
    ];

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function house(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(House::class, 'house_id');
    }

    public function installments(): HasMany
    {
        return $this->hasMany(Installment::class);
    }

    /**
     * Get user's mortgage payment remaining amount
     */
    public function getRemainingLoanAmountAttribute(): int|float
    {
        //        Check if there are any installments available
        if ($this->installments()->count() === 0) {
            return $this->loan_interest_total_amount;
        }

        //        Calculate the total paid amount from installments
        $totalPaid = $this->installments()
            ->where('is_paid', true)
            ->sum('sub_total_amount');

        //        Subtract the total paid amount from the total loan amount
        return max($this->loan_interest_total_amount - $totalPaid, 0);
    }
}
