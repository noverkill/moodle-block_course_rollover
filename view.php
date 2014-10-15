<?php

/****************************************************************

File:     /block/course_rollover/view.php

Purpose:  To render the form to a page on moodle

****************************************************************/

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');

global $DB, $CFG, $USER, $COURSE, $OUTPUT, $PAGE, $EXTDB;

require_once 'classlib.php';
require_once 'forms/course_rollover_form.php';
require_once($CFG->libdir . '/formslib.php');

$cr = new course_rollover(
                get_config('course_rollover'),
                required_param('id', PARAM_INT)
);

if (!$course = $DB->get_record('course', array('id' => $cr->params->id))) {
    print_error("invalidcourseid");
}

require_login();
$conx = get_context_instance(CONTEXT_COURSE, $cr->params->id);
require_capability('block/course_rollover:manage', $conx);
$PAGE->set_context($conx);
$PAGE->set_url('/blocks/course_rollover/view.php', array('id' => $cr->params->id));
$PAGE->set_pagelayout('course');
$PAGE->set_course($course);

//create Page navigation
//$pagenode = $PAGE->settingsnav->add(get_string('blocktitle', 'block_course_rollover'));
//$pagenode->make_active();
$renderer = $PAGE->get_renderer('block_course_rollover');

$rollover_form = new block_course_rollover_form(
                null,
                array(
                    'id' => $cr->params->id,
                    'mod_code' => $course->idnumber,
                    'course_rollover_config' => $cr->course_rollover_config,
                    'edit_mode' => course_rollover::scheduled($cr->params->id),
                    'blockid' => optional_param('blockid', 0, PARAM_INT)
                )
);

echo $OUTPUT->header();

$site = get_site();

if ($rollover_form->is_cancelled()) {
    echo 'redirecting...';
    redirect(new moodle_url('/course/view.php', array('id' => $cr->params->id)));
} else if ($cr->form = $rollover_form->get_data()) {
    // find out if the Module is in the MIS database or not
    $cr->get_sits_module($cr->form->modcode);
    echo $renderer->display_rollover_comfirmation($cr, $course);
    $data = course_rollover::schedule(
                    $cr->course_rollover_config->general_resets, $cr->course_rollover_config->activities_settings, $cr->form, $course
    );
    echo $renderer->schedule_footer($data, $cr);
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
