<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearnAttachment extends Model
{
    protected $table = 'learn_attachments';
    public $timestamps = false;
    protected $fillable = ['learn_id', 'filename', 'file_url'];
}
