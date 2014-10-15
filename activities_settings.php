<?php

/****************************************************************

File:     /block/course_rollover/activities_settings.php

Purpose:  To render the form to a page on moodle

****************************************************************/

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once dirname(__FILE__) . '/classlib.php';
require_once dirname(__FILE__) . '/forms/activities_settings_form.php';

global $DB, $CFG, $USER, $OUTPUT, $PAGE, $COURSE;

//FIXME !!!!!
require_login(0, false);

$conx = get_context_instance(CONTEXT_SYSTEM);
$PAGE->set_context($conx);
$PAGE->set_url('/blocks/course_rollover/activities_settings.php');
$PAGE->set_pagelayout('course');

//create Page navigation
$pagenode = $PAGE->settingsnav->add(get_string('header_activity', 'block_course_rollover'));
$pagenode->make_active();
$course_rollover_config = get_config('course_rollover');
echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('header_activity', 'block_course_rollover'));
echo $OUTPUT->box(get_string('header_activity_desc', 'block_course_rollover'));

$site = get_site();
$mform = new activities_settings_form(null, array('default' => $course_rollover_config->activities_settings));

if ($mform->is_cancelled()) {
    echo 'redirecting...';
    redirect($CFG->wwwroot);
} else if ($fromform = $mform->get_submitted_data()) {
    set_config('activities_settings', json_encode($fromform), 'course_rollover');
    $mform->display();
} else {
    // form didn't validate or this is the first display
    $site = get_site();
    $mform->display();
}

echo $OUTPUT->footer();

?>
