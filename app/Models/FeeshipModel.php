<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeshipModel extends Model {

    public $timestamps = false; //set time to false
    protected $fillable = [
        'fee_matp', 'fee_maqh', 'fee_xaid', 'fe_feeship'
    ];
    protected $primaryKey = 'fee_id';
    protected $table = 'tbl_feeship';

    public function city_model() {
        return $this->belongsTo('App\Models\CityModel', 'fee_matp');
    }
    
    public function province_model() {
        return $this->belongsTo('App\Models\ProvinceModel', 'fee_maqh');
    }

    public function wards_model() {
        return $this->belongsTo('App\Models\WardsModel', 'fee_xaid');
    }
}
