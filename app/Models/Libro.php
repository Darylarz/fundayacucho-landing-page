<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $fillable = ['title', 'cover_image_path', 'pdf_file_path'];
}