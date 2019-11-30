<?php

namespace App\Broadcasting;

use App\User;

class TrackerLocationChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     * ! Add proper authentication logic here
     * 
     * @param  \App\User  $user
     * @return array|bool
     */
    public function join($user, $tracker_id)
    {
        return true;
    }
}
