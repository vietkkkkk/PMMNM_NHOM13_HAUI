<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminModel extends Authenticatable {
    
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'admin_user', 'admin_password', 'admin_name', 'admin_phone'
    ];
    protected $primaryKey = 'admin_id';
 	protected $table = 'admin';

 	public function roles(){
 		return $this->belongsToMany('App\Models\RolesModel');
 	}

	public function getAuthPassword() {
		 return $this->admin_password;
	}

	public function hasAnyRoles($roles) {
		//  return null !== $this->roles()->whereIn('name', $roles)->first();
		if(is_array($roles)){
			foreach($roles as $role){
				if($this->hasRole($role)){
					return true;
				}
			}
		}else{
			if($this->hasRole($roles)){
				return true;
			}
		}
		return false;
	}

	public function hasRole($role) {
		// return null !== $this->roles()->whereIn('name', $role)->first();
		if($this->roles()->where('name',$role)->first()){
			return true;
		}
		return false;
	}
}
