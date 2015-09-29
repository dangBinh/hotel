<?php

namespace App\Commands;

use App\Commands\Command;

class ReserveRoomCommand extends Command
{
    public $user;
    public $rooms;
    public $start_date;
    public $end_date;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(User $user, $start_date, $end_date, $rooms)
    {
        $this->user = $user;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->rooms = $rooms;
    }
}
