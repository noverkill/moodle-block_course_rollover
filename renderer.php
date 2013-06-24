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
 * @package    renderer
 * @category   '$PWD'
 * @copyright  2013 Queen Mary University Gerry Hall
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

class block_course_rollover_renderer extends plugin_renderer_base
{

    public function display_rollover_comfirmation($cr, $course)
    {

        $html = parent::heading(s('Schedule Rollover for ' . $course->fullname), 3);
        $html .= 'Schedule Date : ' . userdate($cr->form->scheduled_date, '%A, %d %B %Y');
        $html .= html_writer::empty_tag('br');
		$datearr = check_in_range(
									$cr->course_rollover_config->schedule_day,
									$cr->course_rollover_config->cutoff_day,
									$cr->form->scheduled_date
								);
								
		if( $datearr['error']){
			// the set rollover date is passed the cutoff date so the course will not be rolled over
			$html .= parent::notification(get_string("messages_{$datearr['message']}", 'block_course_rollover'), 'red'); 
		} 
		if(empty($cr->mis_course)){ // no sits module 
			$html .= $this->display_no_sits_course_data();
		} else { 
			// there is a sits module found less display the data
			$html .= $this->display_sits_course_data($cr->mis_course);
		}		

        return $html;
    }

    /**
     * display_sits_course_data
     * displays the sits module information with optional description
     */
    public function display_sits_course_data($mis_course)
    {
        $html = parent::heading(s(get_string('header_sits_module_info', 'block_course_rollover')), 3);
        $string = get_string('header_sits_module_info_desc', 'block_course_rollover');
        if (strlen(trim($string)) != 0) {
            $html .= parent::box(s($string), 3);
        }

        $html .= $this->render_label_data_element('Module Name', $mis_course['COURSE_NAME']);
        return $html .= html_writer::empty_tag('br');
    }

	/**
     * display_current_course_data
     * displays the current module information with optional description
     */
    public function display_current_course_data($moodle_course)
    {
        $html = parent::heading(s(get_string('header_current_module_info', 'block_course_rollover')), 3);
        $string = get_string('header_current_module_info_desc', 'block_course_rollover');
        if (strlen(trim($string)) != 0) {
            $html .= parent::box(s($string));
        }

        $html .= $this->render_label_data_element('Module Name', $moodle_course->fullname);
        return $html .= html_writer::empty_tag('br');
    }

    public function display_no_sits_course_data()
    {
        $html = parent::heading(s(get_string('header_no_sits_module_info', 'block_course_rollover')), 3);
        $string = get_string('header_no_sits_module_info_desc', 'block_course_rollover');
        if (strlen(trim($string)) != 0) {
            $html .= parent::notification(s($string));
        }
        return $html .= html_writer::empty_tag('br');
    }

	public function schedule_footer($data , $cr) 
	{
		$state = ($data[key($data)] == 1) ? 'success' : 'fail';	
		$html = html_writer::start_tag('p');	
			$html.= html_writer::tag('span', get_string( 'messages_'. key($data) .'_' .$state , 'block_course_rollover'),
        			array('class'=>'block_course_has_schedule'));		
		$html .= html_writer::end_tag('p');
		$url = new moodle_url('/course/view.php', array('id' => $cr->params->id));
		$html .= html_writer::tag(
								'span',
								html_writer::link($url, 'Return to course'),
        						array('class'=>'footer_link')
										);
		return $html;	
	}
	
	public function display_scheduled_overview()
	{
		$table = new html_table();
		$table->head  = array('Module','Schedule Time', 'Scheduled By');
    	$table->size  = array('60%', '20%', '20%');
    	$table->align = array('left', 'center', 'center');
    	$table->attributes['class'] = 'scaletable localscales generaltable';
    	$table->data  = $data;
		
		$html = parent::heading(s(get_string('header_scheduled_overview', 'block_course_rollover')), 3);
        $string = get_string('header_scheduled_overview_desc', 'block_course_rollover');
        if (strlen(trim($string)) != 0) {
            $html .= parent::box(s($string));
        }
        return $html .= html_writer::empty_tag('br');
		
	}

	public function block_course_has_schedule(&$content, $instanceid, $courseid , $scheduled){
		if($scheduled->status == 1){
		$content->text = null;
		$content->footer = null;	
		} else {
			$a = new stdclass();
			$a->scheduled_date = userdate($scheduled->scheduletime, '%A, %d %B %Y');
			//TODO do we need a editmode ??
			$url = new moodle_url('/blocks/course_rollover/view.php', array('blockid' => $instanceid, 'id' => $courseid));
			$content->text .= html_writer::start_tag('p');
			$content->text .= html_writer::tag('span', get_string( 'block_course_has_schedule', 'block_course_rollover' ,$a ),
        			array('class'=>'block_course_has_schedule'));
			$content->text .= html_writer::end_tag('p');
        	$content->footer = html_writer::tag(
											'span',
											html_writer::link($url, get_string('block_course_has_schedule_link', 'block_course_rollover')),
        									array('class'=>'block_footer_desc')
										);
		}
		
		 
	}
		
	public function block_course_schedule(&$content, $instanceid, $courseid){
		
		$url = new moodle_url('/blocks/course_rollover/view.php', array('blockid' => $instanceid, 'id' => $courseid));
		$content->text .= html_writer::start_tag('p');
		$content->text .= html_writer::tag('span', get_string( 'block_footer_desc', 'block_course_rollover' ),
        			array('class'=>'block_footer_desc'));
		$content->text .= html_writer::end_tag('p');
        $content->footer = html_writer::tag(
											'span',
											html_writer::link($url, get_string('block_footer_link', 'block_course_rollover')),
        									array('class'=>'block_footer_desc')
										);
	
	}
	
	/**
	* Course Rollover Reports
	*/
	
    public function sceduled_rollover_report($show = null)
    {
		GLOBAL $DB, $EXTDB;
		
		
		$table = new html_table();
		$table->head  = array('Module','Schedule Time', 'Scheduled By');
    	$table->size  = array('60%', '20%', '20%');
    	$table->align = array('left', 'center', 'center');
    	$table->attributes['class'] = 'scaletable localscales generaltable';
    	$table->data  = $data;
    }

	/**
	* Helpers
	*/

	public function render_label_data_element($label, $data, $extra = array())
    {
        $html = html_writer::start_tag('div', $extra);
        $html .= html_writer::start_tag('strong');
        $html .= s($label) . ' : ';
        $html .= html_writer::end_tag('strong');
        $html .= html_writer::end_tag('em');
        $html .= s($data);
        $html .= html_writer::end_tag('em');
        return $html .= html_writer::end_tag('div');
    }

}
