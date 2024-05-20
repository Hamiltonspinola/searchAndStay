<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentStore extends Model
{
    use HasFactory;
    protected $table = 'stores';
    protected $fillable = ['name', 'address', 'active'];
    
    public function books()
    {
        return $this->belongsToMany(EloquentBook::class, 'book_store', 'store_id', 'book_id');
    }
}

