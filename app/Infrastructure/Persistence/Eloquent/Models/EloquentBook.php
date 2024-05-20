<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentBook extends Model
{
    use HasFactory;

    protected $table    = 'books';
    protected $fillable = ['name', 'isbn', 'value'];
}
