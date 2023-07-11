<?php

namespace App\Http\Controllers\Event;

use App\Events\VideoCounter;
use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getcount(){
        $video = Video::first();
        event(new VideoCounter($video));
        return view('video')->with('video',$video);
    }
}
