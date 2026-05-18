<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_np',
        'slug',
        'image',
        'status',
        'order'
    ];

    protected $table = 'post_categories';
}
