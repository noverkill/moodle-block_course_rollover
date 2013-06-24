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
 * @package    schedule_overview
 * @category   '$PWD'
 * @copyright  2013 Queen Mary University Gerry Hall
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
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


echo $OUTPUT->header();
	$site = get_site();
	if (course_rollover::scheduled($cr->params->id) {
		$renderer->report();
	} else {
		
	}
	
echo $OUTPUT->footer();
	


?>

