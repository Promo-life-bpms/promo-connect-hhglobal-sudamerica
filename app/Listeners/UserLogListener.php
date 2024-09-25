<?php

namespace App\Listeners;

use App\Models\UserLogs;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserLogListener
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
    public function handle($event)
    {
        //
    }

    public function handleLogin(Login $event)
    {
        $this->logAction($event->user->id, 'auth', 'login', $event->user->current_location);
    }

    /**
     * Handle the logout event.
     *
     * @param  \Illuminate\Auth\Events\Logout  $event
     * @return void
     */
    public function handleLogout(Logout $event)
    {
        $this->logAction($event->user->id, 'auth', 'logout', $event->user->current_location);
    }

    /**
     * Log the user action.
     *
     * @param  int  $userId
     * @param  string  $type
     * @param  string  $value
     * @return void
     */
    protected function logAction($userId, $type, $value, $location)
    {
        UserLogs::create([
            'user_id' => $userId,
            'type' => $type,
            'value' => $value,
            'location' => $location
        ]);
    }
}
