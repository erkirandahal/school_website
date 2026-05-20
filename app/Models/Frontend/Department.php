<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'title_np', 'slug', 'order', 'status'];

    protected $table = 'departments';

    public function officials()
    {
        return $this->hasMany('App\Models\Frontend\Official');
    }
}
