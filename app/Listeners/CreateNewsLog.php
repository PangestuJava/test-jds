<?php

namespace App\Listeners;

use App\Events\NewsCreated;
use App\Models\ActivityLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateNewsLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewsCreated  $event
     * @return void
     */
    public function handle(NewsCreated $event)
    {
        ActivityLog::create([
            'description' => 'Create News' . $event->news->title
        ]);
    }
}
