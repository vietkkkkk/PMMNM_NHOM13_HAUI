<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model {
    
    public $timestamps = false; //set time to false
    protected $fillable = [
        'name_mess', 'phone_mess', 'email_mess', 'content_mess', 'mess_status'
    ];
    protected $primaryKey = 'mess_id';
    protected $table = 'tbl_message';
}
