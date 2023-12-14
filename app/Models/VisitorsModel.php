<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorsModel extends Model {

    public $timestamps = false; //set time to false
    protected $fillable = [
        'ip_address', 'date_visitor'
    ];
    protected $primaryKey = 'id_visitors';
    protected $table = 'tbl_visitors';
}
