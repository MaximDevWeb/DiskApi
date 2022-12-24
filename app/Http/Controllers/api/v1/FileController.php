<?php

namespace App\Http\Controllers\api\v1;

use App\Events\FileCreated;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileResource;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'folder' => 'string|nullable'
        ]);

        $folder = $request->input('folder');
        $folder_id = null;

        if ($folder) {
            $folder = str_contains($folder, '/') ? $folder : '/' . $folder;
            $folder_res = Folder::where(DB::raw('CONCAT(COALESCE(`prefix`, ""), "/", slug)'), $folder)->first();
            $folder_id = $folder_res->id;
        }

        $files = File::where('folder_id', $folder_id)->get();

        return response()->json([
            'status' => 'success',
            'files' => FileResource::collection($files),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'file' => 'required|file'
        ]);

        $folder_name = explode('/', $request->input('folder'));
        $folder_slug = array_pop($folder_name);
        $folder_prefix = implode('/', $folder_name);

        $folder = Folder::where('prefix', $folder_prefix ?: null)->where('slug', $folder_slug)->first();

        $file_original_name = $request->file('file')->getClientOriginalName();
        $file_original_size = $request->file('file')->getSize();
        $file_original_ext = $request->file('file')->getClientOriginalExtension();

        $file_name = md5(time()) . ".$file_original_ext";
        $path = $request->file('file')->storeAs('user_files', $file_name);

        $file = new File();
        $file->user_id = Auth::id();
        $file->folder_id = $folder ? $folder->id : null;
        $file->name = $file_original_name;
        $file->size = $file_original_size;
        $file->type = $file_original_ext;
        $file->link = $path;
        $file->save();

        Event::dispatch(new FileCreated($file->id));

        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param File $file
     * @return JsonResponse
     */
    public function update(Request $request, File $file)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $file->name = $request->name;
        $file->save();

        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param File $file
     * @return JsonResponse
     */
    public function destroy(File $file)
    {
        Storage::delete($file->link);
        $file->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Generate public file link
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function generatePublicLink(Request $request): JsonResponse
    {
        $file = File::find($request->id);
        $file->links->public_hash = md5($file->id . time());
        $file->push();

        return response()->json([
            'status' => 'success',
            'file' => new FileResource($file)
        ]);
    }

    /**
     * Generate public file link
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function deletePublicLink(Request $request): JsonResponse
    {
        $file = File::find($request->id);
        $file->links->public_hash = null;
        $file->push();

        return response()->json([
            'status' => 'success',
            'file' => new FileResource($file)
        ]);
    }
}
