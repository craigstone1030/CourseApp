<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    protected $table = "categories";
    protected $timestamp = false;
    protected $fillable = [
        'title',
        'description',
        'category_image',
        'published',
        'parent_id'
    ];


    public function getPublishedAttribute($attribute){
        return [
            0 => 'Inactive',
            1 => 'Active'
        ][$attribute];
    }
}

