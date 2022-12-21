<?php

namespace App\Listeners;

use App\Events\FileCreated;
use App\Models\Link;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateFileLink
{
    /**
     * Handle the event.
     *
     * @param FileCreated $event
     * @return void
     */
    public function handle(FileCreated $event)
    {
        $link = new Link();
        $link->file_id = $event->file_id;
        $link->private_hash = md5($event->file_id . time());
        $link->save();
    }
}
