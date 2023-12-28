<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

        public $timestamps = false;

    protected $fillable = [
        'amount',
        'balance'
    ];

    public function accounts()
    {
        return $this->belongsTo('App\Account', 'account_no');
    }
}
