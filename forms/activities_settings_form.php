<?php

/****************************************************************

File:     /block/course_rollover/forms/activities_settings_form.php

Purpose:  Form to create rollover a course

****************************************************************/

// No direct script access.
defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir . '/formslib.php');
require_once($CFG->dirroot . '/course/lib.php');

class activities_settings_form extends moodleform
{

    public function definition()
    {
        global $CFG, $DB;
        $mform = & $this->_form;
        if ($allmods = $DB->get_records_list('modules', 'name', explode(',', get_config('course_rollover', 'activity_resets')))) {
            foreach ($allmods as $mod) {
                $modname = $mod->name;
                $modfile = $CFG->dirroot . "/mod/$modname/lib.php";
                $mod_reset_course_form_definition = $modname . '_reset_course_form_definition';
                $mod_reset__userdata = $modname . '_reset_userdata';
                if (file_exists($modfile)) {
                    include_once($modfile);
                    if (function_exists($mod_reset_course_form_definition)) {
                        $mod_reset_course_form_definition($mform);
                    }
                } else {
                    debugging('Missing lib.php in ' . $modname . ' module');
                }
            }
        }

        foreach (json_decode($this->_customdata['default']) as $setting => $value) {
            $mform->setDefault($setting, $value);
        }

        $buttonarray = array();
        $buttonarray[] = &$mform->createElement('submit', 'submitbutton', get_string('save_activities_settings', 'block_course_rollover'));
        $buttonarray[] = &$mform->createElement('submit', 'selectdefault', get_string('selectdefault'));
        $buttonarray[] = &$mform->createElement('submit', 'deselectall', get_string('deselectall'));
        $buttonarray[] = &$mform->createElement('cancel');
        $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
        $mform->closeHeaderBefore('buttonar');
    }

    function load_defaults()
    {
        global $CFG, $COURSE, $DB;

        $mform = & $this->_form;

        $defaults = array();
        if ($allmods = $DB->get_records_list('modules', 'name', explode(',', get_config('course_rollover', 'activity_resets')))) {
            foreach ($allmods as $mod) {
                $modname = $mod->name;
                $modfile = $CFG->dirroot . "/mod/$modname/lib.php";
                $mod_reset_course_form_defaults = $modname . '_reset_course_form_defaults';
                if (file_exists($modfile)) {
                    @include_once($modfile);
                    if (function_exists($mod_reset_course_form_defaults)) {
                        if ($moddefs = $mod_reset_course_form_defaults($COURSE)) {
                            $defaults = $defaults + $moddefs;
                        }
                    }
                }
            }
        }

        foreach ($defaults as $element => $default) {
            $mform->setDefault($element, $default);
        }
    }

}
