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
 * Language strings for Course Rollover block.
 *
 * @package      blocks
 * @subpackage   course_rollover
 * @license      http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
// No direct script access.
defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Course Rollover';
$string['blocktitle'] = 'QMplus Course Rollover Scheduling';


//User form stings

$string['scheduled_date'] = 'Scheduled date';
$string['scheduled_date_help'] = 'Add the date that you would like to schedule the rollover for your QMplus module.';
$string['schedule_rollover'] = 'Schedule Rollover';
$string['confirm_rollover'] = 'Confirm Rollover';
$string['mod_code'] = 'Module Code';
$string['mod_code_help'] = 'Please check the code for your module. If the code has changed please replace the code with the correct version.';

$string['reset_events'] = 'Reset Events';
$string['reset_events_help'] = 'Reset Events';
$string['reset_logs'] = 'Reset Logs';
$string['reset_logs_help'] = 'Reset Logs';

$string['reset_notes'] = 'Reset Notes';
$string['reset_notes_help'] = 'Reset Notes';

$string['reset_comments'] = 'Reset Comments';
$string['reset_comments_help'] = 'Reset Comments';

$string['reset_course_completion'] = 'Reset Comments';
$string['reset_course_completion_help'] = 'Reset Comments';

$string['reset_forums'] = 'Reset Forums';
$string['reset_forums_help'] = 'Yes: All live data from the forums you have set up on your module will be removed. This includes your news and announcements area. No: All forum postings in your module will be retained.';
$string['reset_groupings'] = 'Reset Groupings';
$string['reset_groupings_help'] = 'Reset Groupings';


$string['titles_reset_items_fields'] = 'General';
$string['titles_map_mods_fields'] = 'Custom enrolment rules';
$string['titles_scheduled_items_fields'] = 'Schedule rollover';

//sceduled overview page text
$string['header_scheduled_overview'] = 'Scheduled Course Rollover Overview';
$string['header_scheduled_overview_desc'] = 'Below is an overview of the scheduled rollover for this course';

$string['header_scheduled_overview_desc_error'] = 'The following Course isn\'t currently scheduled for a rollover or reset';

//Messages
$string['messages_returntitle'] = 'Your Course Rollover has been schedauled';
$string['messages_extention'] = 'Your Course Rollover has been schedauled past the 1st of August which is the cut off date';
$string['messages_confirmation'] = 'Please ensure the data below is correct';
$string['messages_introduction'] = "Welcome to the course rollover scheduler. We do the rollover by ‘resetting’  your module. On this page you can schedule the reset for your course.<br \>
This form should be completed by all those who would prefer to start work on developing their module for the next academic year prior to August 1st.<br \>
On that date all remaining modules will be rolled over.<br \>
There is a full description of the rollover process in a user guide which is available here.<br \>
Please select the help icon (?) to access more details about the information we require in the fields below.";

$string['messages_comfirmation_extention'] = '** You have request for a course rollover after the cut off date';
$string['messages_strat_date_error'] = '** You have request for a course rollover before the rollover period we will run this schedule on the {$a}';
$string['messages_insert_success'] = 'Have have successfully scheduled your course rollover';
$string['messages_insert_fail'] = 'Insert Falied';
$string['messages_update_success'] = 'Have have successfully updated you scheduled your course rollover';
$string['messages_update_fail'] = 'Updated Failed';

// Settings Tbas
$string['tab_settings'] = 'Configure Settings';
$string['tab_external_database_options'] = 'Configure External Database';
$string['tab_activity_reset_options'] = 'Configure Activity Reset';


// Settings Headers.
$string['header_config'] = 'Configure the Course Rollover Block';
$string['header_config_desc'] = '';

$string['header_general'] = 'General Reset Options';
$string['header_general_desc'] = 'You can set a new Course Start Date for the freshly reset course, delete all Calendar events, comments, course AND activity completion data, course log report data and user notes attached to the course.';

$string['header_roles'] = 'Role Reset Options';
$string['header_roles_desc'] = 'These Role Reset options allow you to unenrol all users with a particular role within a course (e.g students) as well as remove all role overrides and role assignment specific to the course. This does not affect user role assignments outside the context of the course.';

$string['header_gradebook'] = 'Gradebook Reset Options';
$string['header_gradebook_desc'] = 'The Gradebook reset options allow you to delete all gradebook items and categories and/or delete all recorded grades within the course. Note that these grades are still recorded against a user\'s account.';

$string['header_group'] = 'Group Reset Options';
$string['header_group_desc'] = 'The Group reset options provides you with the ability to delete all groups created in the course and/or remove all users from any groups within the course.
You can also delete all groupings created in the course and/or remove all users from any groupings within the course.';

$string['header_external_database'] = 'External Database';
$string['header_external_database_desc'] = 'Below you can setup a external database which allows the block to use for validation and auto population of required fields';

$string['header_activity'] = 'Activity Reset Options';
$string['header_activity_desc'] = 'Depending on the activities used within a course, you will be provided with the option to remove the user data associated with these learning objects. This includes responses to Choices, Quiz attempts, Feedback Responses, Forum posts (from selected Forum types), Glossary entries etc.
You can remove all attempts from all quizzes.
You can also specify a new course start date.';

$string['header_activities_settings'] = 'Activity Reset Settings';
$string['header_activities_settings_desc'] = 'The following Section allows you to show Activity reset settings to the end user if any of the following items are deslected they will show
 on the course rollover block regardless if they are have default values set on the Activity Reset Options page';
$string['header_activity_defaults'] = 'Activity Reset Settings';

$string['confirmation'] = "Please confirm this rollover Request";
//
$string['save_activities_settings'] = 'Save Activity Reset Settings';

$string['header_sits_module_info'] = 'New SITS Module Information';
$string['header_sits_module_info_desc'] = 'Below contain the information for your selected module for the then acidemic year';

$string['header_current_module_info'] = 'Current Module Information';
$string['header_current_module_info_desc'] = 'Below is the information';



$string['header_no_sits_module_info'] = 'no SITS Module Information';
$string['header_no_sits_module_info_desc'] = 'There was no SITS Module found for this course.';

// Settings Titles
$string['descconfig'] = 'The Below Settings are forced Setting meaning Course Administrators can not override them';
$string['activeate_Description'] = 'When the Block should be displayed on courses';
$string['reset_date'] = 'Reset Date';
$string['reset_date_desc'] = 'The date the block should be displayed on the course page';
$string['reset_cutoff_day'] = 'Cutoff Date';
$string['reset_cutoff_day_desc'] = 'The Cutoff Date is the date the last day a user can request a rollover before it becomes a extention request';

$string['reset_events'] = 'Reset Events';
$string['reset_events_desc'] = 'Resets all events within the selected course';
$string['reset_logs'] = 'Reset Logs';
$string['reset_logs_desc'] = 'Resets all events within the selected course';
$string['reset_notes'] = 'Reset Notes';
$string['reset_notes_desc'] = 'Resets all notes within the selected course';
$string['reset_comments'] = 'Reset Comments';
$string['reset_comments_desc'] = 'Resets all comments within the selected course';
$string['reset_completion'] = 'Reset Completion';
$string['reset_completion_desc'] = 'Resets all ompletion within the selected course';
$string['delete_blog_associations'] = 'Delete Blog Associations';
$string['delete_blog_associations_desc'] = 'Delect all associted blogs within the selected course';
$string['reset_roles_local'] = 'Reset Local Roles';
$string['reset_roles_local_desc'] = 'Resets local roles within the selected course';
$string['reset_gradebook_items'] = 'Reset Gradebook Items';
$string['reset_gradebook_items_desc'] = 'Resets all gradebook items within the selected course';
$string['reset_gradebook_grades'] = 'Reset Gradebook Grades';
$string['reset_gradebook_grades_desc'] = 'Resets gradebook grades within the selected course';
$string['reset_groupings_remove'] = 'Remove Groupings';
$string['reset_groupings_remove_desc'] = 'Remove all groupings within the selected course';
$string['reset_groupings_members'] = 'Reset Groupings Members';
$string['reset_groupings_members_desc'] = 'Resets all groupings members within the selected course';
$string['reset_groups_remove'] = 'Remove Groups';
$string['reset_groups_remove_help'] = 'Remove all groups within the selected course';
$string['course_data'] = 'Allow Course Data';
$string['course_data_desc'] = 'Allow the user to edit the course Data like shortname, fullnname, Description and idnumber';
$string['reset_roles'] = 'Reset Roles';
$string['reset_roles_desc'] = 'Allows the Course Administrator to reset role within thier course';
$string['allow_backup'] = 'Allow Backup';
$string['allow_backup_desc'] = 'Allow Course Administrators to Create a backup of thier course before resetting';
$string['run_time'] = 'Run Time';
$string['run_time_desc'] = 'When should the Automatic Process run';
$string['unenrol_users'] = 'Roles';
$string['roles_desc'] = 'Select the roles you DO want removed form a course during the rollover';

$string['reset_assignment_submissions'] = 'Reset Assignment Submissions';
$string['reset_assignment_submissions_desc'] = 'reset_assignment_submissions_desc';

$string['reset_forum_all'] = 'Reset Forum';
$string['reset_forum_all_desc'] = 'reset_freset_forum_all_descorum_all';

$string['reset_forum_subscriptions'] = 'Reset Forum Subscriptions';
$string['reset_forum_subscriptions_desc'] = 'reset_forum_subscriptions_desc';

$string['block_course_has_schedule'] = 'This course has been sheduled for a rollover on the {$a->scheduled_date}';
$string['block_course_has_schedule_link'] = 'Edit schedule';
$string['block_footer_link'] = 'Schedule a rollover date';
$string['block_footer_desc'] = 'Set up a time to rollover your course';

/**
 * mis_connection
 */
$string['noconnection'] = 'no connection';
$string['db_connection'] = 'Database Type';
$string['db_connection_desc'] = 'PLease select the database type.';
$string['db_name'] = 'Database Name';
$string['db_name_desc'] = 'Enter a Database Name';
$string['db_host'] = 'Database Host';
$string['db_host_desc'] = 'Enter a Database Host';
$string['db_prefix'] = 'Table Prefix';
$string['db_prefix_desc'] = 'Enter a Prefix, Emtpy means no prefix';
$string['db_table'] = 'Database Table';
$string['db_table_desc'] = 'Enter a Database Table that the course data is stored in';
$string['db_user'] = 'Database User';
$string['db_user_desc'] = 'Enter a Database Username used to login to the database';
$string['db_pass'] = 'Database Password';
$string['db_pass_desc'] = 'Enter a Database password used to login to the database';

/**
 * course data mapping
 */
$string['data_mapping'] = 'Data mapping';
$string['data_mapping_desc'] = 'Please enter the data mapping this data will be used to validate course information for new course and also auto populate the modual code field';

$string['data_mapping_module_code'] = 'Module Code';
$string['data_mapping_module_code_desc'] = 'The Field that holds course Module Code (idnumber) in the external database';
$string['data_mapping_fullname'] = 'Course Title';
$string['data_mapping_fullname_desc'] = 'The Field that holds course Title in the external database';
$string['data_mapping_shortname'] = 'Course short Name';
$string['data_mapping_shortname_desc'] = 'The Field that holds course short name in the external database';
$string['data_mapping_summary'] = 'Course Description';
$string['data_mapping_summary_desc'] = 'The Field that holds course droleescription in the external database';

$string['data_mapping_category'] = 'Course Category';
$string['data_mapping_category_desc'] = 'The Field that holds course Category in the external database';


$string['action_button_finished'] = 'Finished';
$string['confirm_reset'] = 'confirm reset';
// message string
$string['messageprovider:confirmation'] = 'Confirmation of your course rollover submissions';
$string['messageprovider:submission'] = 'Notification of course rollover submissions';

//email stuff
$string['emailnotifysubject'] = '{$a->firstname} {$a->lastname} has Scheduled a course rollover for {$a->fullname}';
$string['emailnotifybody'] = 'Course rollover Scheduled';
$string['emailnotifysmall'] = 'Course rollover Scheduled';



// Capabilities strings.
$string['course_rollover:view'] = 'View Course Rollover Block';
$string['course_rollover:manage'] = 'Manage Course Rollover Block';

// Errors.
$string['error:no_course_to_rollover'] = 'No Course with this ID has been found';
$string['error:newerror'] = 'A error has happened';
$string['error:mod_code_mixmatch'] = 'The Code you have select does not match the current code are you should you wish to continue ?';

