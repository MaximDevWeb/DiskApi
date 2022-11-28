<?php

namespace App\Models;

use App\Models\Scopes\MyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new MyScope());
    }
}
