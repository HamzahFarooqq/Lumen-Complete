<?php 

namespace app\Models;

use Illuminate\Database\Eloquent\Model;


class Article extends Model {
    
 protected $fillable = ['title', 'content', 'user_id'];


}