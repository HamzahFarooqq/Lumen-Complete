<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'country', 'city', 'priority'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}