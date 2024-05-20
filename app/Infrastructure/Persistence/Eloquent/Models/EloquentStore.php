<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class EloquentStore extends Model
{
    protected $table = 'stores';
    protected $fillable = ['name', 'address', 'active'];
}

