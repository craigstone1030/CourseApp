<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Learn extends Model
{
    protected $table = 'learn';
    protected $timestamp = false;
    protected $fillable = ['title', 'content', 'resolved_num', 'received_num', 'response_time','category_id'];
}
