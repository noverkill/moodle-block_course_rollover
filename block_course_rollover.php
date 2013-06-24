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

require_once 'locallib.php';
require_once 'classlib.php';

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

    public function applicable_formats()
    {
        return array(
            'site-index' => true,
            'course' => true,
            'mod' => false,
            'course-cat' => false,
        );
    }

    public function get_content()
    {
        global $CFG, $PAGE, $COURSE, $DB;
		
	    $currentcontext = $this->page->context;
		$renderer = $PAGE->get_renderer('block_course_rollover');
        $config = get_config('course_rollover');
        $context = context_course::instance($COURSE->id);
        $showdate = explode('-', $config->schedule_day);

        $this->content = new stdClass();
        //don't show its on a catigoy page
		if ($PAGE->context->contextlevel != 40) {
			//don't show if we are out of the schedule range
			$rangetest = check_in_range($config->schedule_day, $config->cutoff_day, time());
            if ($rangetest['date'] !== false || $COURSE->id != 1) {
                if ( has_capability('block/course_rollover:manage', $context) ) {
                	if( $scheduled = course_rollover::scheduled($COURSE->id) ) {
						$renderer->block_course_has_schedule($this->content, $this->instance->id, $COURSE->id ,$scheduled);
					} else {
						$renderer->block_course_schedule($this->content, $this->instance->id, $COURSE->id);
					}
				} else { 
					$this->content->footer = '';
                }
            }
        }

        return $this->content;
    }

    public function cron()
    {
        mtrace("Getting List of Courses");
        mtrace("Rollover Course $shortname to $new_shortname");
        mtrace("Getting List of Courses");

        global $DB; // Global database object

        $instances = $DB->get_records('block_instance', array('blockid' => 'course_rollover'));

        foreach ($instances as $instance) {
            $block = block_instance('course_rollover', $instance);
            $someconfigitem = $block->config->item2;
        }


        // do something

        return true;
    }

}
