<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'users_id',
        'loan_amount',
        'total_installments',
        'interest_rate',
        'loan_start_date',
        'loan_status',
    ];
}

