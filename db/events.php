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
 * @package     rgu_contact_us
 * @subpackage  block
 * @copyright   2012 Gerry Hall gerryghall@googlemail.com
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* List of handlers that this block uses */
$handlers = array (
    'message_send ' => array (
        'handlerfile'      => '/block/rgu_contact_us/lib.php',
        'handlerfunction'  => 'message_sent',
        'schedule'         => 'instant',
        'internal'         => 0,
   )
);
