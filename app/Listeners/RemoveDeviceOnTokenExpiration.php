<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\TokenExpired;
class RemoveDeviceOnTokenExpiration
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
     * @param  object  $event
     * @return void
     */
    public function handle(TokenExpired $event)
    {
        // Remove the device record
        \App\UserDevice::where('user_id', $event->userId)
            ->where('device_id', $event->deviceId)
            ->delete();
    }
}
