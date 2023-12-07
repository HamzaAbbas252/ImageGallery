<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'filename',
        'relative_path',
        'width',
        'height',
        'hash_value'
    ];


        // Explicitly defining the primary key
        protected $primaryKey = 'id';

        // Auto-incrementing primary key
        public $incrementing = true;
    
}
