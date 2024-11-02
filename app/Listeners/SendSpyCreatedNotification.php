<?php

namespace App\Listeners;

use App\Events\SpyCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SendSpyCreatedNotification implements ShouldQueue
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
    public function handle(SpyCreated $event): void
    {
        # Now right here, we could add a happy little email notification.
        Log::info('Spy ' . $event->spy->name . ' ' . $event->spy->surname . ' was created');
    }
}
