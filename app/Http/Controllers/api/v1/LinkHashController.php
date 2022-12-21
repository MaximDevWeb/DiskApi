<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\LinkHash;
use Illuminate\Http\Request;

class LinkHashController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $link_hash = new LinkHash();
        $link_hash->hash = bin2hex(random_bytes(20));
        $link_hash->save();

        return response()->json([
            'status' => 'success',
            'hash' => $link_hash->hash
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
