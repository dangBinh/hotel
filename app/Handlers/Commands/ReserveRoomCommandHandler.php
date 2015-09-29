<?php

namespace App\Handlers\Commands;

use App\Commands\ReserveRoomCommand;
use Illuminate\Queue\InteractsWithQueue;

class ReserveRoomCommandHandler
{
    /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the command.
     *
     * @param  ReserveRoomCommand  $command
     * @return void
     */
    public function handle(ReserveRoomCommand $command)
    {
        $reservation = new \MyCompany\Accommodation\ReservationValidator();
        $reservation->validate($command->start_date, $command->end_date, $command->rooms);
    }
}
