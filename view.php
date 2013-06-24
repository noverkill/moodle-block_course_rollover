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
 * this file is use to render the form to a page on moodle
 * @package     rgu_contact_us
 * @subpackage  block
 * @copyright   2012 Gerry Hall gerryghall@googlemail.com
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');

global $DB, $CFG, $USER, $COURSE, $OUTPUT, $PAGE;

require_once 'classlib.php';
require_once 'forms/course_rollover_form.php';
require_once($CFG->libdir . '/formslib.php');

$cr = new course_rollover(
					required_param('id', PARAM_INT),
					get_config('course_rollover')
);

if (!$course = $DB->get_record('course', array('id'=>$cr->params->id))) {
   print_error("invalidcourseid");
}

require_login();
$conx = get_context_instance(CONTEXT_COURSE, $cr->params->id);
require_capability('block/course_rollover:manage', $conx);
$PAGE->set_context($conx);
$PAGE->set_url('/blocks/course_rollover/view.php', array('id' => $cr->params->id) );
$PAGE->set_pagelayout('course');
$PAGE->set_course($course);

//create Page navigation
$pagenode = $PAGE->settingsnav->add(get_string('blocktitle', 'block_course_rollover'));
$pagenode->make_active();
$renderer =  $PAGE->get_renderer('block_course_rollover');

$rollover_form = new block_course_rollover_form(
												null, 
												array(
														'id'=>$cr->params->id,
														'mod_code'=>$course->idnumber,
														'course_rollover_config'=>$cr->course_rollover_config,
														'edit_mode'=>course_rollover::scheduled($cr->params->id)
														)
												);

echo $OUTPUT->header();
	$site = get_site();
if($rollover_form->is_cancelled()) {
	echo 'redirecting...';
    redirect(new moodle_url('/course/view.php', array('id' => $cr->params->id)));
} else if ($cr->form = $rollover_form->get_data()) {
	// find out if the Module is in the MIS database or not 
	$cr->mis_course = course_rollover::get_course($cr->form->mod_code);
	echo $renderer->display_rollover_comfirmation($cr, $course);
	
	$data = course_rollover::schedule(
							$cr->course_rollover_config->general_resets, 
							$cr->course_rollover_config->activities_settings, 
							$cr->form, 
							$course
					);
					
	echo $renderer->schedule_footer($data , $cr);
} else {
	
    // form didn't validate or this is the first display
	echo $OUTPUT->heading(get_string('blocktitle', 'block_course_rollover'));
	echo $OUTPUT->box(get_string('messages_introduction', 'block_course_rollover'));
	$rollover_form->display();
}
	echo $OUTPUT->footer();
	//remember to close the extrnal Datbase connection
	$EXTDB->Close();

?>
