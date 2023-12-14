<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model {

    public $timestamps = true; //set time to false
    protected $fillable = [
        'cate_post_id', 'post_title', 'post_image', 'post_slug', 'post_desc', 'post_content', 'post_status', 'created_at'
    ];
    protected $primaryKey = 'post_id';
    protected $table = 'tbl_posts';

    public function cate_post() {
        return $this->belongsTo('App\Models\CatePostModel', 'cate_post_id');
    }
}
