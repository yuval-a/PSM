<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //

    protected $table = 'sales';
    protected $fillable = ['sale_time','sale_number','description','amount','currency','payment_link'];
}
