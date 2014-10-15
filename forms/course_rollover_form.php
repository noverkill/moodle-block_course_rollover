<?php

/****************************************************************

File:     /block/course_rollover/forms/course_rollover_form.php

Purpose:  Form to create rollover a course

****************************************************************/

// No direct script access.
defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');
require_once($CFG->dirroot . '/course/lib.php');

class block_course_rollover_form extends moodleform
{

    public function definition()
    {
        global $CFG, $DB;
        $this->build_rollover_form();
    }

    private function build_rollover_form()
    {
        global $CFG, $DB;
        $mform = & $this->_form;
        $course_rollover_config = $this->_customdata['course_rollover_config'];
        //find out which general reset otions the user can set them self
        $general_resets = explode(',', $course_rollover_config->general_resets);

        $mform->addElement('header', 'scheduled_items', get_string('titles_scheduled_items_fields', 'block_course_rollover'), null, false);
        $mform->addElement('date_selector', 'scheduled_date', get_string('scheduled_date', 'block_course_rollover'), array('startyear' => date('Y'), 'stopyear' => date('Y'), 'timezone' => 99, 'optional' => false));
        $mform->addRule('scheduled_date', null, 'required', null, 'client');
        $mform->addHelpButton('scheduled_date', 'scheduled_date', 'block_course_rollover');
        $default_modcode = (isset($this->_customdata['edit_mode']->modcode)) ? $this->_customdata['edit_mode']->modcode : $this->_customdata['mod_code'];
        course_rollover::get_form_modcode($mform, $default_modcode);
        // resettable items
        if (count($general_resets) < 11) {
            $mform->addElement('header', 'reset_items', get_string('titles_reset_items_fields', 'block_course_rollover'), null, false);
        }

        if (!in_array('reset_events', $general_resets)) {
            $mform->addElement('selectyesno', 'reset_events', get_string('reset_events', 'block_course_rollover'));
            $mform->setDefault('reset_events', 1);
            $mform->addHelpButton('reset_events', 'reset_events', 'block_course_rollover');
        }
        if (!in_array('reset_logs', $general_resets)) {
            $mform->addElement('selectyesno', 'reset_logs', get_string('reset_logs', 'block_course_rollover'));
            $mform->setDefault('reset_logs', 1);
            $mform->addHelpButton('reset_logs', 'reset_logs', 'block_course_rollover');
        }
        if (!in_array('reset_notes', $general_resets)) {
            $mform->addElement('selectyesno', 'reset_notes', get_string('reset_notes', 'block_course_rollover'));
            $mform->setDefault('reset_notes', 1);
            $mform->addHelpButton('reset_notes', 'reset_notes', 'block_course_rollover');
        }
        if (!in_array('reset_comments', $general_resets)) {
            $mform->addElement('selectyesno', 'reset_comments', get_string('reset_comments', 'block_course_rollover'));
            $mform->setDefault('reset_comments', 1);
            $mform->addHelpButton('reset_comments', 'reset_comments', 'block_course_rollover');
        }

        if (!in_array('reset_course_completion', $general_resets)) {
            $mform->addElement('selectyesno', 'reset_course_completion', get_string('reset_course_completion', 'block_course_rollover'));
            $mform->setDefault('reset_course_completion', 1);
            $mform->addHelpButton('reset_course_completion', 'reset_course_completion', 'block_course_rollover');
        }

        if (!in_array('delete_blog_associations', $general_resets)) {
            $mform->addElement('selectyesno', 'delete_blog_associations', get_string('delete_blog_associations', 'block_course_rollover'));
            $mform->setDefault('delete_blog_associations', 1);
            $mform->addHelpButton('delete_blog_associations', 'delete_blog_associations', 'block_course_rollover');
        }

        if (!in_array('reset_gradebook_items', $general_resets)) {
            $mform->addElement('selectyesno', 'reset_gradebook_items', get_string('reset_gradebook_items', 'block_course_rollover'));
            $mform->setDefault('reset_gradebook_items', 1);
            $mform->addHelpButton('reset_gradebook_items', 'reset_gradebook_items', 'block_course_rollover');
        }

        if (!in_array('reset_gradebook_grades', $general_resets)) {
            $mform->addElement('selectyesno', 'reset_gradebook_grades', get_string('reset_gradebook_grades', 'block_course_rollover'));
            $mform->setDefault('reset_gradebook_grades', 1);
            $mform->addHelpButton('reset_gradebook_grades', 'reset_gradebook_grades', 'block_course_rollover');
        }
        if (!in_array('reset_groupings_remove', $general_resets)) {
            $mform->addElement('selectyesno', 'reset_groupings_remove', get_string('reset_groupings_remove', 'block_course_rollover'));
            $mform->setDefault('reset_groupings_remove', 1);
            $mform->addHelpButton('reset_groupings_remove', 'reset_groupings_remove', 'block_course_rollover');
        }
        if (!in_array('reset_groupings_members', $general_resets)) {
            $mform->addElement('selectyesno', 'reset_groupings_members', get_string('reset_groupings_members', 'block_course_rollover'));
            $mform->setDefault('reset_groupings_members', 1);
            $mform->addHelpButton('reset_groupings_members', 'reset_groupings_members', 'block_course_rollover');
        }
        if (!in_array('reset_groups_remove', $general_resets)) {
            $mform->addElement('selectyesno', 'reset_groups_remove', get_string('reset_groups_remove', 'block_course_rollover'));
            $mform->setDefault('reset_groups_remove', 1);
            $mform->addHelpButton('reset_groups_remove', 'reset_groups_remove', 'block_course_rollover');
        }

        if ($allmods = $DB->get_records('modules')) {
            $activity_resets = explode(',', $course_rollover_config->activity_resets);
            foreach ($allmods as $mod) {
                if (!$DB->count_records($mod->name, array('course' => $this->_customdata['id']))) {
                    continue; // skip mods with no instances
                }
                $modfile = $CFG->dirroot . "/mod/$mod->name/lib.php";
                $mod_reset_course_form_definition = $mod->name . '_reset_course_form_definition';
                $mod_reset__userdata = $mod->name . '_reset_userdata';
                if (file_exists($modfile)) {
                    include_once($modfile);
                    if (function_exists($mod_reset_course_form_definition)) {
                        if (!in_array($mod->name, $activity_resets)) {
                            $mod_reset_course_form_definition($mform);
                        }
                    }
                }
            }
        }
        if (isset($this->_customdata['edit_mode']->course_reset_data)) {
            $setdefault = json_decode($this->_customdata['edit_mode']->course_reset_data);
            $mform->setDefault('scheduled_date', $this->_customdata['edit_mode']->scheduletime);
        } else {
            //setting what has been setting by the administrator as the default
            if (!empty($course_rollover_config)) {
                $setdefault = json_decode($course_rollover_config->activities_settings);
            }
        }

        foreach ($setdefault as $setting => $value) {
            if ($mform->elementExists($setting)) {
                $mform->setDefault($setting, $value);
            }
        }


        $mform->addElement('hidden', 'id');
        $mform->setDefault('id', $this->_customdata['id']);
        $mform->addElement('hidden', 'blockid');
        $mform->setDefault('blockid', $this->_customdata['blockid']);
        $mform->addElement('hidden', 'unenrol_users', $this->_customdata['course_rollover_config']->unenrol_users);
        $this->add_action_buttons(true, get_string('schedule_rollover', 'block_course_rollover'));
    }

    function validation($data, $files)
    {
        $errors = parent::validation($data, $files);
        if (array_key_exists('scheduled_date', $data)) {
            if ($data['scheduled_date'] < $this->_customdata['course_rollover_config']->schedule_day) {
                $errors['scheduled_date'] = get_string('messages_start_date_error', 'block_course_rollover');
            }
        }
        return $errors;
    }

}
