<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentBook extends Model
{
    use HasFactory;

    protected $table    = 'books';
    protected $fillable = ['name', 'isbn', 'value'];

    public function stores()
    {
        return $this->belongsToMany(EloquentStore::class, 'book_store', 'book_id', 'store_id');
    }
}