<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Message Event Handler
 *
 * @package     course_rollover
 * @subpackage  block
 * @copyright   2012 Gerry Hall gerryghall@googlemail.com
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* List of handlers that this block uses */
$handlers = array (
    'course_rollover_scheduled ' => array (
        'handlerfile'      => '/block/course_rollover/classlib.php',
        'handlerfunction'  => 'course_rollover::notification',
        'schedule'         => 'instant',
        'internal'         => 1,
   ),
	'course_rollover_commpleted ' => array (
       'handlerfile'      => '/block/course_rollover/classlib.php',
       'handlerfunction'  => 'course_rollover::notification',
       'schedule'         => 'cron',
       'internal'         => 1,
  )
);

/* List of events generated by the course_rollover block, with the fields on the event object.

course_rollover_scheduled
    ->component   = 'block_course_rollover';
    ->scheduledtime   = // The timestamp of when the rollover has been scheduled.
    ->userid      = // The user id that the course belongs to.
    ->courseid    = // The course id of the course the quiz belongs to.

course_rollover_commpleted
    ->component   = 'block_course_rollover';
    ->runtime  = // The timestamp of when the attempt was submitted.
    ->userid      = // The user id that the course belongs to.
    ->submitterid = // The user id of the user who sumitted the scheduled.
    ->courseid    = // The course id of the course the quiz belongs to.

*/

