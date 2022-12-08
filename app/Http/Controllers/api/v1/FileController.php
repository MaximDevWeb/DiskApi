<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
