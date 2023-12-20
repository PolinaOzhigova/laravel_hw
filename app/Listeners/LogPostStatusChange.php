<?php

namespace App\Listeners;

use App\Events\PostStatusChanged;
use Illuminate\Support\Facades\Log;

class LogPostStatusChange
{
    public function handle(PostStatusChanged $event)
    {
        $post = $event->post;

        Log::info("Post '{$post->title}' status changed to '{$post->status}'");
    }
}
