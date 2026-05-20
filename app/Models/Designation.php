<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = [
        'name',
        'name_np',
        'order',
        'slug'
    ];

    protected $table = 'designations';

    public function officials()
    {
        return $this->hasMany('App\Models\Frontend\Official');
    }
}
