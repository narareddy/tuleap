<?php
/**
 * Copyright (c) Enalean, 2012. All Rights Reserved.
 *
 * This file is a part of Tuleap.
 *
 * Tuleap is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Tuleap is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Tuleap. If not, see <http://www.gnu.org/licenses/>.
 */

require_once 'BurndownTimePeriod.class.php';

class Tracker_Chart_Data_Burndown {

    /**
     * @var Tracker_Chart_Data_BurndownTimePeriod
     */
    private $time_period;

    private $remaining_effort = array();
    private $ideal_effort     = array();
    private $day_counter      = array();

    public function __construct(Tracker_Chart_Data_BurndownTimePeriod $time_period) {
        $this->time_period = $time_period;
        $this->day_counter = $time_period->getStartDate();
    }

    /**
     * @return int The Burndown time period duration in days.
     */
    private function getDuration() {
        return $this->time_period->getDuration();
    }

    public function addRemainingEffort($remaining_effort) {
        $this->remaining_effort[] = $remaining_effort;
        $this->day_counter = strtotime("+1 day", $this->day_counter);
    }

    public function getRemainingEffort() {
        for ($i = 0; $i < $this->getDuration(); $i++) {
            if (!isset($this->remaining_effort[$i])) {
                $this->addRemainingEffort($last_value);
            }
            if ($this->day_counter > time()) {
                $last_value = null;
            } else {
                $last_value = $this->remaining_effort[$i];
            }
        }
        return $this->remaining_effort;
    }

    public function getHumanReadableDates() {
        return $this->time_period->getHumanReadableDates();
    }

    public function getIdealEffort() {
        $start_effort = $this->remaining_effort[0];
        $slope        = - ($start_effort / $this->getDuration());

        for($i = 0; $i < $this->getDuration(); $i++) {
            $this->ideal_effort[] = floatval($slope * $i + $start_effort);
        }
        return $this->ideal_effort;
    }
}

?>
