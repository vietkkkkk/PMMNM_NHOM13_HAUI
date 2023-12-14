<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideosModel extends Model {

    public $timestamps = false; //set time to false
    protected $fillable = [
        'video_name', 'video_slug', 'video_link', 'video_image'
    ];
    protected $primaryKey = 'video_id';
    protected $table = 'tbl_videos';
}
