<?php

namespace App\Models;

use App\Models\Scopes\MyScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Folder extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new MyScope());
    }

    public function info(): Attribute {
        return Attribute::make(
            get: fn () => $this->folderInfo($this),
        );
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    public function folders()
    {
        return Folder::where('prefix', ($this->prefix ? $this->prefix . '/' : '') . $this->slug)->get();
    }

    private function folderInfo($folder): array {
        $size = 0;
        $foldersCount = 0;
        $filesCount = 0;

        if (count($folder->folders())) {
            foreach ($folder->folders() as $item) {
                $info = $this->folderInfo($item);

                $size += $info['size'];
                $foldersCount += $info['foldersCount'];
                $filesCount += $info['filesCount'];

                $foldersCount += 1;
            }
        }

        foreach ($folder->files as $file) {
            $filesCount += 1;
            $size += $file->size;
        }

        return [
            'size' => $size,
            'foldersCount' => $foldersCount,
            'filesCount' => $filesCount
        ];
    }
}
