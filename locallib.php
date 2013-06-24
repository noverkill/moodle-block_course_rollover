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
 * This is a one-line short description of the file
 *
 * You can have a rather longer description of the file as well,
 * if you like, and it can span multiple lines.
 *
 * @package    locallib
 * @category   '$PWD'
 * @copyright  2013 Queen Mary University Gerry Hall
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * this is still being developed
 */
 global $CFG, $DB, $EXTDB;

function course_rollover_send_notification_messages($course, $context,  $course_rollover) {
    global $CFG, $DB;

    // Do nothing if required objects not present
    if (empty($course) or empty($course_rollover) or empty($context)) {
        throw new coding_exception('$course and  $course_rollover must all be set.');
    }

    $submitter = $DB->get_record('user', array('id' => $course_rollover->userid), '*', MUST_EXIST);

    // Check for confirmation required
    $sendconfirm = false;
    $notifyexcludeusers = '';
    if (has_capability('block/course_rollover:emailconfirmsubmission', $context, $submitter, false)) {
        $notifyexcludeusers = $submitter->id;
        $sendconfirm = true;
    }

}

function check_in_range($start, $end, $date)
{
	$return = array();
	$return['date'] = false;
	if(($date >= $start)){
		
	 $return['message'] = 'strat_date_error';
	 $return['error'] = true;
	
	} elseif ($date <= $end) {
		
		$return['message'] = 'comfirmation_extention';
		$return['error'] = true;
	}
	
	$return['output'] = 'scheduled_date';
	$return['date'] = userdate( $date ,'%A, %d %B %Y');
	
  return $return;
}

function db_init($config, $force = false)
   {
       GLOBAL $EXTDB;
       if (empty($EXTDB) || $force) {
           $EXTDB = ADONewConnection($config->dbconnectiontype);
           $EXTDB->Connect($config->db_host, $config->db_user, $config->db_pass, $config->db_name, true);
           $EXTDB->SetFetchMode(ADODB_FETCH_ASSOC);
       }
       return $EXTDB;
   }



/**
 * Sends notification messages to the interested parties that assign the role capability
 *
 * @param object $recipient user object of the intended recipient
 * @param object $a associative array of replaceable fields for the templates
 *
 * @return int|false as for {@link message_send()}.
 */
function course_rollover_send_notification($recipient, $submitter, $a) {

    global $USER;

    // Recipient info for template
    $a->useridnumber = $recipient->idnumber;
    $a->username     = fullname($recipient);
    $a->userusername = $recipient->username;

    // Prepare message
    $eventdata = new stdClass();
    $eventdata->component         = 'block_course_rollover';
    $eventdata->name              = 'submission';
    $eventdata->notification      = 1;

    $eventdata->userfrom          = $submitter;
    $eventdata->userto            = $recipient;
    $eventdata->subject           = get_string('emailnotifysubject', 'block_course_rollover', $a);
    $eventdata->fullmessage       = get_string('emailnotifybody', 'block_course_rollover', $a);
    $eventdata->fullmessageformat = FORMAT_PLAIN;
    $eventdata->fullmessagehtml   = '';

    $eventdata->smallmessage      = get_string('emailnotifysmall', 'block_course_rollover', $a);
    $eventdata->contexturl        = $a->courseurl;
    $eventdata->contexturlname    = $a->coursename;

    // ... and send it.
    return message_send($eventdata);
}
