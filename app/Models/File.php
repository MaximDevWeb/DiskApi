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

    public static array $images = ["jpeg", "jpg", "png", "svg", "webp", "bmp", "tiff", "raw", "ai", "eps", "ps", "psd", "fig"];
    public static array $documents = ["doc", "docx", "pdf", "xls", "xlsx", "txt", "rtf", "odt", "ods"];
    public static array $archives = ["zip", "zipx", "rar", "tar", 'tar.gz', 'gz'];

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

    public function publicLink(): Attribute
    {
        return Attribute::get(
            fn() => $this->links->public_hash
                ? action([LinkController::class, 'public'], ['hash' => $this->links->public_hash])
                : null
        );
    }
}
