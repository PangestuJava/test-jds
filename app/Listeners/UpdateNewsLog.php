<?php

namespace App\Listeners;

use App\Events\NewsUpdated;
use App\Models\ActivityLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateNewsLog
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
     * @param  \App\Events\NewsUpdated  $event
     * @return void
     */
    public function handle(NewsUpdated $event)
    {
        ActivityLog::create([
            'description' => 'Update News' . $event->news->title
        ]);
    }
}
