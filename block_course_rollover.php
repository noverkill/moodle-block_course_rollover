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
 * Course Rollover Block.
 *
 * @package      blocks
 * @subpackage   course_rollover
 * @license      http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once dirname(__FILE__) . '/locallib.php';
require_once dirname(__FILE__) . '/classlib.php';

GLOBAL $DB;

class block_course_rollover extends block_base
{

    public function init()
    {
        $this->title = get_string('pluginname', 'block_course_rollover');
    }

    public function instance_allow_multiple()
    {
        return false;
    }
	/**
     * don't allow the user to configure a block instance
     * @return bool Returns false
     */
    function instance_allow_config() {
        return false;
    }

    public function applicable_formats()
    {
        return array(
			'site' => false,
            'site-index' => true,
            'course' => true,
            'mod' => false,
            'report' => false,
			'my' => false
        );
    }

	function has_config() {
        return true;
    }
	/**
	 * get_content moodle internal function that is used to get the content of a block 
	 *
	 * @return the content of block_course_rollover
	 * @author Gerry G Hall
	 */
    public function get_content()
    {
        global $PAGE, $COURSE;
		
		
        $currentcontext = $this->page->context;
        $renderer = $PAGE->get_renderer('block_course_rollover');

        $this->content = new stdClass();

        if ($this->show_content()) {
            if (has_capability('block/course_rollover:manage', $currentcontext)) {
                if ($scheduled = course_rollover::scheduled($COURSE->id)) {
                    $renderer->block_course_has_schedule($this->content, $this->instance->id, $COURSE->id, $scheduled);
                } else {
                    $renderer->block_course_schedule($this->content, $this->instance->id, $COURSE->id);
                }
            } else {
                $this->content->footer = '';
            }
        }

		
        return $this->content;
    }

	/**
	 * show_content is a helper function to determine if the block should or should not show with in certain 
	 * context and statuses 
	 *
	 * @return void
	 * @author Gerry G Hall
	 */
    private function show_content()
    {
	 global $PAGE, $COURSE;
        $return = true;
		$config = get_config('course_rollover');
        $rangetest = course_rollover::check_in_range($config->schedule_day, $config->cutoff_day, time());
		$status =  course_rollover::get_schedule_status($COURSE->id);
		
		
		if($rangetest['date'] !== false)
        $return = (
                ($rangetest['date'] !== false ) && //don't show if we are out of the schedule range
                ($COURSE->id != SITEID) && //don't show if we on the frontpage (SITEID)
                ((int)$status < 399) && // don't show if the status is set higher than 399
                ($PAGE->context->contextlevel == CONTEXT_COURSE) // must be course contextlevel
                );

        $return = ($this->instance->id == optional_param('blockid', 0, PARAM_INT)) ? false : $return;
		$return = ((int)$status > 599) ? true : $return;
        return $return;
    }

	/**
	 * cron expose this block to the  global Moodle cron process
	 * this function runs at the set interval in the version.php file.
	 * the code finds 5 records that are scheduled for now BETWEEN $config->schedule_day AND $config->cutoff_day t
	 * will  
	 * @return void
	 * @author Gerry G Hall
	 */
    public function cron()
    {
        global $CFG, $DB, $EXTDB; // Globals
		$config = get_config('course_rollover');
        $EXTDB = course_rollover::db_init($config);
        mtrace(" Getting List of Courses \n");
        $courses_to_rollover = $DB->get_records_sql("
					SELECT
						*
					FROM
						mdl_block_course_rollover
					WHERE
						FROM_UNIXTIME(scheduletime , '%m-%y') 
							BETWEEN 
								FROM_UNIXTIME(? , '%m-%y') 
							AND 
								FROM_UNIXTIME(? , '%m-%y')
					AND 
					(status > ? AND status < ? )
					AND 
					scheduletime < UNIX_TIMESTAMP(NOW())", array($config->schedule_day, $config->cutoff_day,'99', '400'), 0, 5);

        if ($courses_to_rollover) {

            foreach ($courses_to_rollover as $c) {
                if (course_rollover::rollover($c)) {
                    mtrace($c->shortname .' New code '. $c->modcode . ' Old code '. $c->idnumber . ' - Rollover successful');
					error_log($c->id . ' ' .  $c->modcode . ' - Rollover successful' . "\n", 3, $CFG->dataroot . "/temp/course_rollover_errors.log");
                } else {
                    mtrace($c->modcode . '- Rollover failed');
					error_log($c->id . ' ' .  $c->modcode . ' - Rollover failed' . "\n", 3, $CFG->dataroot . "/temp/course_rollover_errors.log");
                }
            }
        } else {
            mtrace("No Courses to rollover \n");
        }

        return true;
    }

}
