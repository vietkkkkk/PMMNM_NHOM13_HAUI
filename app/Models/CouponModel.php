<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponModel extends Model {

    public $timestamps = false; //set time to false
    protected $fillable = [
        'coupon_name', 'coupon_code', 'coupon_time', 'coupon_condition', 'coupon_number'
    ];
    protected $primaryKey = 'coupon_id';
    protected $table = 'coupon';
}
