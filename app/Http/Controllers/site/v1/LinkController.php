<?php

namespace App\Http\Controllers\site\v1;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Scopes\MyScope;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LinkController extends Controller
{
    public function private(string $hash): StreamedResponse
    {
        $file = File::withoutGlobalScope(MyScope::class)
            ->whereHas('links', function ($query) use ($hash) {
                $query->where('private_hash', $hash);
            })
            ->first();


        return response()->streamDownload(
            function() use ($file) {
                fpassthru(Storage::readStream($file->link));
            },
            $file->name,
            [
                'Content-Length' => $file->size,
                'Content-Type' => Storage::mimeType($file->link)
            ]
        );
    }

    public function public(string $hash)
    {

    }
}
