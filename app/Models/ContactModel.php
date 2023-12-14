<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model {

    public $timestamps = false; //set time to false
    protected $fillable = [
        'info_contact', 'info_map', 'info_image'
    ];
    protected $primaryKey = 'info_id';
    protected $table = 'tbl_information';
}
