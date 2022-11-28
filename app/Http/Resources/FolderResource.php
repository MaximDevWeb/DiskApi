<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FolderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $folderInfo = $this->info;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'sub_folders_count' => $folderInfo['foldersCount'],
            'files_count' => $folderInfo['filesCount'],
            'files_size' => $folderInfo['size'],
        ];
    }
}
