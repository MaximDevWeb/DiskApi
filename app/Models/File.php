<?php

namespace App\Models;

use App\Http\Controllers\site\v1\LinkController;
use App\Models\Scopes\MyScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class File extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new MyScope());
    }

    public function links(): HasOne
    {
        return $this->hasOne(Link::class);
    }

    public function privateLink(): Attribute
    {
        return Attribute::get(fn() => action([LinkController::class, 'private'], ['hash' => $this->links->private_hash]));
    }
}
