<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FolderResource;
use App\Models\Folder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $prefix = $request->input('prefix');

        $folders = Folder::where('prefix', $prefix)
            ->where('type', 'folder')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json([
            'status' => 'success',
            'folders' => FolderResource::collection($folders)
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
            'name' => 'required|string',
            'prefix' => 'string|nullable'
        ]);

        $name = $request->input('name');
        $slug = Str::slug($name, '-');
        $prefix = $request->input('prefix');

        $is_not_unique = Folder::where('name', $name)->where('prefix', $prefix)->first();

        if ($is_not_unique) {
            return response()->json(['errors' => [
                'name' => ['The name must be unique']
            ]], 422);
        }

        $folder = new Folder();
        $folder->user_id = auth()->id();
        $folder->prefix = $prefix;
        $folder->name = $name;
        $folder->slug = $slug;
        $folder->save();

        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Folder $folder
     * @return JsonResponse
     */
    public function update(Request $request, Folder $folder): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'prefix' => 'string|nullable'
        ]);

        $name = $request->input('name');
        $slug = Str::slug($name, '-');
        $prefix = $request->input('prefix');

        $is_not_unique = Folder::where('name', $name)->where('prefix', $prefix)->first();

        if ($is_not_unique) {
            return response()->json(['errors' => [
                'name' => ['The name must be unique']
            ]], 422);
        }

        $folder->name = $name;
        $folder->slug = $slug;
        $folder->save();

        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Folder $folder
     * @return JsonResponse
     * @throws \Throwable
     */
    public function destroy(Folder $folder): JsonResponse
    {

        $this->deleteFolder($folder);

        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Cascade delete folders
     *
     * @param Folder $folder
     * @return void
     * @throws \Throwable
     */
    private function deleteFolder(Folder $folder): void {
        if (count($folder->folders())) {
            foreach ($folder->folders() as $item) {
                $this->deleteFolder($item);
            }
        }

        $folder->deleteOrFail();
    }
}
