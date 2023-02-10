<?php

namespace App\Listeners;

use App\Events\NewsDeleted;
use App\Models\ActivityLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteNewsLog
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
     * @param  \App\Events\NewsDeleted  $event
     * @return void
     */
    public function handle(NewsDeleted $event)
    {
        ActivityLog::create([
            'description' => 'Delete News' . $event->news->title
        ]);
    }
}
