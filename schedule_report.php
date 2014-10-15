<?php

/****************************************************************

File:     /block/course_rollover/schedule_report.php

Purpose:  To render the form to a page on moodle

****************************************************************/

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');

global $DB, $CFG, $USER, $COURSE, $OUTPUT, $PAGE;

require_once dirname(__FILE__) . '/locallib.php';
require_once dirname(__FILE__) . '/classlib.php';

$params['type'] = optional_param('type', 0, PARAM_INT);
$params['page'] = optional_param('page', 0, PARAM_INT);
$params['limit'] = optional_param('limit', 20, PARAM_INT);
$params['sort'] = optional_param('sort', '', PARAM_ALPHA);

// Szilard: add column sorting feature for the data table
$params['ord'] = optional_param('ord', '', PARAM_ALPHA);
$params['dir'] = optional_param('dir', '', PARAM_ALPHA);

if (! in_array($params['ord'], array('shortname','scheduletime'))) $params['ord'] = 'shortname';
if (! in_array($params['dir'], array('','ASC','DESC'))) $params['dir'] = '';
// 21/07/32014 -----------------------------------

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

