<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'installment_number',
        'date',
        'payment_amount',
        'interest',
        'collection_fee',
        'principal_return',
        'remaining_balance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}