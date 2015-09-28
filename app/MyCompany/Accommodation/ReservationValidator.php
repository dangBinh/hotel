<?php

namespace MyCompany\Accommodation;

use Carbon\Carbon;

class ReservationValidator
{
    const MINIMUM_STAY_LENGTH = 1;
    const  MAXIMUM_STAY_LENGTH = 15;
    const MAXIMUM_ROOMS = 4;

    public function shoudlThrow($argument1)
    {
        // TODO: write logic here
    }

    /**
     * @param $start_date
     * @param $end_date
     * @param $rooms
     * @return $this
     */
    public function validate($start_date, $end_date, $rooms)
    {
        $end = Carbon::createFromFormat('Y-m-d', $end_date);
        $start = Carbon::createFromFormat('Y-m-d', $start_date);

        if($this->dayAreWithinAceptalbeRange($end, $start)) {
            throw new \InvalidArgumentException('Requires stay length from.' . self::MINIMUM_STAY_LENGTH . self::MAXIMUM_STAY_LENGTH);
        }

    }

  /**
   * @param $end
   * @param $start
   * @return bool
   */
    private function daysAreLessThanMinimumAllowed($end, $start)
    {
      return $end->diffInDays($start) > self::MINIMUM_STAY_LENGTH;
    }

    /**
     * @param $end
     * @param $start
     * @return bool
     */
    private function daysAreGreaterThanMaximumAllowed($end, $start)
    {
        return $end->diffInDays($start) < self::MAXIMUM_STAY_LENGTH;
    }

    /**
     * @param $end
     * @param $start
     * @return bool
     */
    private function dayAreWithinAceptalbeRange($end, $start) {
        if ($this->daysAreLessThanMinimumAllowed($end, $start) || $this->daysAreGreaterThanMaximumAllowed($end, $start)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $rooms
     * @return bool
     */
    private function tooManyRooms($rooms) {
        return count($rooms) > self::MAXIMUM_ROOMS;
    }

    public function createNew($user, $start_date, $end_date, $rooms)
    {
        $end = Carbon::createFromFormat('Y-m-d', $end_date);
        $start = Carbon::createFromFormat('Y-m-d', $start_date);
        if($this->daysAreLessThanMinimumAllowed($end, $start)) {
            throw new \InvalidArgumentException('Cannot reserve a room for more than fifteen (15) days.');
        }

        if (!is_array($rooms)) {
            throw new \InvalidArgumentException('Rooms must be array');
        }

        if ($this->tooManyRooms($rooms)) {
            throw new \InvalidArgumentException('Too many rooms');
        }

        return $this;
    }

    public function rooms() {
        return $this->belongsToMany('MyCompany\Accommodation\Room')->withTimestamps();
    }
}
