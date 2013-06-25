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
require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');

global $DB, $CFG, $USER, $COURSE, $OUTPUT, $PAGE;

require_once dirname(__FILE__) . '/locallib.php';
require_once dirname(__FILE__) . '/classlib.php';

$params['type'] = optional_param('type', 0, PARAM_INT);
$params['page'] = optional_param('page', 0, PARAM_INT);
$params['limit'] = optional_param('limit', 20, PARAM_INT);
$params['sort'] = optional_param('sort', '', PARAM_ALPHA);

if (!$course = $DB->get_record("course", array("id" => SITEID))) {
    print_error("invalidcourseid");
}
require_login($course);
$conx = get_context_instance(CONTEXT_COURSE, $course->id);
require_capability('block/course_rollover:manage', $conx);
$PAGE->set_context($conx);
$PAGE->set_url('/blocks/course_rollover/schedule_report.php', $params);
$PAGE->set_pagelayout('report');
$pagenode = $PAGE->settingsnav->add(get_string('blocktitle', 'block_course_rollover'));
$pagenode->make_active();
$renderer = $PAGE->get_renderer('block_course_rollover');

add_to_log($course->id, "course_rollover", "view report", "/blocks/course_rollover/schedule_report.php?show=all={$params['type']}", $course->id , $USER->id);
echo $OUTPUT->header();
$site = get_site();

$link = new moodle_url('/blocks/course_rollover/schedule_report.php', array('type' => 0));
$tabs = array();

foreach (course_rollover::get_report_types() as $title => $type) {
    $tabs[] = new tabobject(
                    $title,
                    new moodle_url($link, array('type' => $type)),
                    get_string('tab_' . $title, 'block_course_rollover'),
                    get_string('tab_' . $title, 'block_course_rollover'),
                    false
    );
}
print_tabs(array($tabs), course_rollover::get_report_types($params['type']));

echo $renderer->sceduled_rollover_report($params);

echo $OUTPUT->footer();
?>

