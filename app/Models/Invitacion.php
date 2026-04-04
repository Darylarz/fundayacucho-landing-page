<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitacion extends Model
{
    protected $table = 'invitaciones';
    protected $fillable = ['image_path', 'link', 'title', 'order', 'is_active'];
}