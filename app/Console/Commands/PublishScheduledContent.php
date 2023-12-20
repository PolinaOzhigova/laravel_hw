<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Carbon\Carbon;

class PublishScheduledContent extends Command
{
    protected $signature = 'posts:publish-scheduled';
    protected $description = 'Publish scheduled posts';

    public function handle()
    {
        $this->info('Checking for scheduled posts...');

        $now = Carbon::now();

        $posts = Post::where('status', 'draft')
            ->where(function ($query) use ($now) {
                $query->where('publish_at', '<=', $now)
                    ->orWhereNull('publish_at');
            })
            ->get();

        foreach ($posts as $post) {
            $post->update(['status' => 'published']);
            $this->info("Post '{$post->title}' published successfully.");
        }

        $this->info('Done.');
    }
}