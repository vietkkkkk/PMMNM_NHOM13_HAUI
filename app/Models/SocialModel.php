<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialModel extends Model {

    public $timestamps = false;
    protected $fillable = [
          'provider_user_id',  'provider',  'user'
    ];
 
    protected $primaryKey = 'user_id';
 	protected $table = 'social';

 	public function login() {
 		return $this->belongsTo('App\Login', 'user');
 	}

}
