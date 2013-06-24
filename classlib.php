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
 * @package    classlib
 * @category   course_rollover
 * @copyright  2013 Queen Mary University Gerry Hall
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
// No direct script access.
defined('MOODLE_INTERNAL') || die();
/**#@+
 * Defaults for the block course rollover
 */
define('COURSE_ROLLOVER_DB_TABLE', 'block_course_rollover');
global $DB, $CFG, $EXTDB;

require_once $CFG->libdir . '/adodb/adodb.inc.php';
require_once $CFG->libdir . '/blocklib.php';
require_once 'locallib.php';

class course_rollover
{

    public $params;
	public $course_rollover_config;

    function __construct($id, $config, $force = false)
    {
		GLOBAL $EXTDB;
        $this->renderer = null;
        $this->params = new stdclass();
		$this->params->id = $id;
		$this->course_rollover_config = $config;
		$EXTDB = db_init($this->course_rollover_config, $force);
        
    }


    static function rollover($course_id)
    {
        global $CFG, $DB;

        if ($DB->get_record(COURSE_ROLLOVER_DB_TABLE, array('courseid', '$course_id'))) {
            course_rollover::get_course($mod_code);
            return update_course($course_id, $course_data);
        } else {
            return false;
        }
        course_rollover::reset($course_id);
    }

    static function reset($course_data)
    {
        global $CFG, $DB;
        if ($course_data = $DB->get_record(COURSE_ROLLOVER_DB_TABLE, array('courseid', '$course_id'))) {
            return reset_course_userdata($course_data);
        } else {
            return false;
        }
    }

    static function get_course_list($courseid = false)
    {
        GLOBAL $EXTDB;
        $result = array();

        // fetch course list
        $sql = "SELECT COURSE_SHORT_NAME,  COURSE_ID FROM moodle_course";
        if ($courseid !== false) {
            $sql .=" WHERE COURSE_CATEGORY = (SELECT COURSE_CATEGORY FROM   moodle_course WHERE COURSE_ID = '$courseid')";
        }
        $sql .= " AND (COURSE_ID LIKE '%13' OR COURSE_ID = '$courseid') ORDER BY  MODULE_CODE DESC";
        $rs = $EXTDB->Execute($sql);

        if (!$rs) {
			//TODO Add error stuff!
            print_error('', '');
        } else if (!$rs->EOF) {
            // load the row into $rec in the while statment
            while ($rec = $rs->FetchRow()) {
                // alter the key case of the same object
                $rec = array_change_key_case((array) $rec, CASE_LOWER);
                $result[$rec['course_id']] = $rec['course_short_name'];
            }
        }
        return $result;
    }

    static function get_course($mod_code)
    {
        GLOBAL $EXTDB;
		if(empty($mod_code)){
			return false;
		}
        $sql = "SELECT * FROM moodle_course WHERE COURSE_ID = '" . $mod_code . "'";
        $result = $EXTDB->GetRow($sql);
        return $result;
    }
	
	static function scheduled($courseid) {
		GLOBAL $DB;
		
		if( $schedule = $DB->get_record(COURSE_ROLLOVER_DB_TABLE,array('courseid'=>$courseid))) {
			return $schedule;
		}
		return false;
	}
	
	static function get_schedule($is_scheduled = 0) {
		GLOBAL $DB;
		
		if( $scheduled = $DB->get_record_sql('SELECT * FROM {COURSE_ROLLOVER_DB_TABLE} WHERE hasbeenprocessed = ?', array($is_scheduled))) {
			return $scheduled;
		}
		return false;
	}
	
	
	static function schedule($general_resets, $activities_settings, $form, $course) {
		
		GLOBAL $DB, $USER;
		$returned = array();
		$savedata = new stdclass();
		$savedata->userid = $USER->id;
		$savedata->courseid = $course->id;
		$savedata->idnumber = $course->idnumber;
		$savedata->shortname = $course->shortname;
		$savedata->summary = $course->summary;
		$savedata->scheduletime = $form->scheduled_date;
		$savedata->course_reset_data = 
		json_encode(
					(object)(
							array_fill_keys(
								array_keys(
									array_flip(
										explode(',' , $general_resets)
										)
									),
									1
								)
								 + (array)
									json_decode(
										$activities_settings
									) 
									+ (array)
										$form
							)
				);
		if( $course = course_rollover::scheduled($course->id) ) {
			$savedata->id = $course->id;
			$returned['update']  = $DB->update_record('block_course_rollover', $savedata);
		} else {
			$returned['insert']  = $DB->insert_record('block_course_rollover', $savedata);
		}
			return $returned;
	
		
	}

    static function pre_validate_mod_code($current, $new)
    {
        $selected_code = array_change_key_case(explode("-", $new), CASE_LOWER);
        $current_code = array_change_key_case(explode("-", $current), CASE_LOWER);
        if (is_array($selected_code) && is_array($current_code)) {
            if (count($selected_code) === count($current_code)) {
                if (trim($selected_code[0]) != trim($current_code[0])) {
                    false;
                }
            }
        }
    }
    

}

