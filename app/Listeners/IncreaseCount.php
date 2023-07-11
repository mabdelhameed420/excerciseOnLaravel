<?php

namespace App\Listeners;

use App\Events\VideoCounter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        // 
    }

    /**
     * Handle the event.
     */
    public function handle(VideoCounter $event): void
    {
        $this->updateCounter($event->video);
    }

    public function updateCounter($video){
        $video->count += 1;
        $video->save();
    }
}
