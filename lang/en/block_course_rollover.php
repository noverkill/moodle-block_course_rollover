<?php

/****************************************************************

File:       block/course_rollover/lang/en/block_course_rollover.php

Purpose:    Language file

****************************************************************/

// No direct script access.
defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Course Rollover';
$string['blocktitle'] = 'QMplus Course Rollover Scheduling';


//User form stings

$string['scheduled_date'] = 'Scheduled date';
$string['scheduled_date_help'] = 'Add the date that you would like to schedule the rollover for your QMplus module.';
$string['schedule_rollover'] = 'Schedule Rollover';
$string['confirm_rollover'] = 'Confirm Rollover';
$string['mod_code_select'] = 'Module Code';
$string['mod_code_select_help'] = 'Please select the code for your module for the next academic year. Special enrolment codes should remain the same. ';
$string['mod_code_select_desc'] = 'Please select the code for your module for the next academic year. Special enrolment codes should remain the same.';
$string['mod_code_text'] = 'Module Code';
$string['mod_code_text_help'] = 'Please select the code for your module for the next academic year. Special enrolment codes should remain the same.';
$string['mod_code_text_desc'] = 'Please select the code for your module for the next academic year. Special enrolment codes should remain the same.';


$string['rollover_comfirmation_heading'] = 'Rollover Scheduled';
$string['label_schedule_date'] = 'Scheduled date';


$string['reset_events'] = 'Reset Events';
$string['reset_logs'] = 'Reset Logs';
$string['reset_notes'] = 'Reset Notes';
$string['reset_comments'] = 'Reset Comments';
$string['reset_course_completion'] = 'Reset Comments';
$string['reset_forums'] = 'Reset Forums';
$string['reset_groupings'] = 'Reset Groupings';
$string['reset_groups'] = 'Reset Groupings';

$string['titles_reset_items_fields'] = 'General';
$string['titles_scheduled_items_fields'] = 'Schedule rollover';

//sceduled overview page text
$string['header_scheduled_overview'] = 'Scheduled Course Rollover Overview';
$string['header_scheduled_overview_desc'] = 'Below is an overview of the scheduled rollover for this course';


//Messages

$string['messages_introduction'] = "<p>Welcome to the course rollover scheduler. We do the rollover by ‘resetting’ your module this will remove all the students. You can schedule an automatic reset of your course at any time until the 1st of August.
</p>
<p>There is a full description of the rollover process and a ‘How to’ guide for staff under ‘Help’ on the menu above.</p>
<p>Please select your module code for next year from the dropdown menu. If you do not see your module code in the drop-down list, please scroll to the bottom of the list, and select ‘code not found’. If there is no drop down list beside module code, please leave this field blank or ignore the custom code. 
</p>
";

$string['messages_comfirmation_extention'] = '** You have requested a course rollover after the first of August (SITS progression) your date is {$a->scheduled_date} but the cut off date is {$a->cutoff_day}';
$string['messages_start_date_error'] = 'You have requested a course rollover before the rollover period begins';
$string['messages_insert_success'] = 'You have successfully scheduled the rollover for your module. We will notify you by email when the reset has taken place.';
$string['messages_insert_fail'] = 'Insert Failed';
$string['messages_update_success'] = 'You have successfully updated the rollover for your module. We will notify you by email when the reset has taken place.';
$string['messages_update_fail'] = 'Update Failed';

// Settings Tbas
$string['tab_all'] = 'All';
$string['tab_scheduled'] = 'Scheduled';
$string['tab_processed'] = 'Processed';
$string['tab_notscheduled'] = 'Not Scheduled';
$string['tab_error'] = 'Errors';
$string['tab_nocode'] = 'No Code';
$string['tab_extended'] = 'Extended';
$string['no_report_found'] = 'No report was found for the selected type';
$string['report_all'] = 'All';
$string['report_all_desc'] = 'This report is an overall view of all courses that have either be queued or proccessed by the course rollover block. This includes courses scheduled after SITS progression.';

$string['report_scheduled_heading'] = 'Scheduled';
$string['report_scheduled_desc'] = 'This report displays all courses that are currently queued to be rolled over';
$string['report_processed_heading'] = 'Processed';
$string['report_processed_desc'] = 'This report displays all courses that have been successfully processed by the course rollover block';
$string['report_notscheduled_heading'] = 'Not Scheduled';
$string['report_notscheduled_desc'] = 'This report displays all courses that are visible, not in the Miscellaneous category and have not be scheduled for a rollover';
$string['report_error_heading'] = 'Errors';
$string['report_error_desc'] = 'This report displays all courses that have beeen scheduled and have been issued with one of the processes like course renaming or un-enrolling users';
$string['report_nocode_heading'] = 'No Code';
$string['report_nocode_desc_heading'] = 'This report displays all courses that have been scheduled and the user has stated that they can not find a sits module code for the course. They do this by selecting \' no code found \'  which is the last selectable item. <br /> this is only applicable to standard courses that are in SITS';
$string['report_extended_heading'] = 'Extended';
$string['report_extended_desc'] = 'This report displays all courses that have been scheduled for a rollover after the cut off date that has been set in the settings page for the course rollover block.';



// Settings Headers.

$string['course_rollover_report'] = "Course Rollover Report";
$string['no_records_found'] = 'No Records Found';

$string['header_config'] = 'Configure the Course Rollover Block';
$string['header_config_desc'] = '';

$string['header_general'] = 'General Reset Options';
$string['header_general_desc'] = 'You can set a new Course Start Date for the freshly reset course, delete all Calendar events, comments, course AND activity completion data, course log report data and user notes attached to the course.';

$string['header_roles'] = 'Role Reset Options';
$string['header_roles_desc'] = 'These Role Reset options allow you to unenrol all users with a particular role within a course (e.g students) as well as remove all role overrides and role assignments specific to the course. This does not affect user role assignments outside the context of the course.';

$string['header_gradebook'] = 'Gradebook Reset Options';
$string['header_gradebook_desc'] = 'The Gradebook reset options allow you to delete all gradebook items and categories and/or delete all recorded grades within the course. Note that these grades are still recorded against a user\'s account.';

$string['header_external_database'] = 'External Database';
$string['header_external_database_desc'] = 'Below you can setup an external database which allows the block to be used for validation and auto population of required fields';

$string['header_activity'] = 'Activity Reset Options';
$string['header_activity_desc'] = 'Depending on the activities used within a course, you will be provided with the option to remove the user data associated with these learning objects. This includes responses to Choices, Quiz attempts, Feedback Responses, Forum posts (from selected Forum types), Glossary entries etc.
You can remove all attempts from all quizzes.';

$string['header_activities_settings'] = 'Activity Reset Settings';
$string['header_activities_settings_desc'] = 'The following Section allows you to show Activity reset settings to the end user. If any of the following items are deselected they will show
 on the course rollover block regardless of whether they have default values set on the Activity Reset Options page';
$string['header_activity_defaults'] = 'Activity Reset Settings';

$string['confirmation'] = "Please confirm this rollover request";
//
$string['save_activities_settings'] = 'Save Activity Reset Settings';

$string['header_sits_module_info'] = 'New SITS Module Information';
$string['header_sits_module_info_desc'] = '';

$string['display_sits_module_name'] = 'Module Name: ';

$string['header_current_module_info'] = 'Current Module Information';
$string['header_current_module_info_desc'] = 'Below is the information';



$string['header_no_sits_module_info'] = 'no SITS Module Information';
$string['header_no_sits_module_info_desc'] = 'There was no SITS Module found for this course.';

// Settings Titles
$string['descconfig'] = 'The settings below are forced settings meaning Course Administrators cannot override them';
$string['activeate_Description'] = 'When the Block should be displayed on courses';
$string['reset_date'] = 'Reset Date';
$string['reset_date_desc'] = 'The date the block should be displayed on the course page';
$string['reset_cutoff_day'] = 'Cutoff Date';
$string['reset_cutoff_day_desc'] = 'The Cutoff Date is the last day a user can request a rollover before it becomes an extention request';

$string['reset_events'] = 'Reset Events';
$string['reset_events_desc'] = 'Resets all events within the selected course';
$string['reset_logs'] = 'Reset Logs';
$string['reset_logs_desc'] = 'Resets all events within the selected course';
$string['reset_notes'] = 'Reset Notes';
$string['reset_notes_desc'] = 'Resets all notes within the selected course';
$string['reset_comments'] = 'Reset Comments';
$string['reset_comments_desc'] = 'Resets all comments within the selected course';
$string['reset_completion'] = 'Reset Completion';
$string['reset_completion_desc'] = 'Resets all completion within the selected course';
$string['delete_blog_associations'] = 'Delete Blog Associations';
$string['delete_blog_associations_desc'] = 'Delete all associated blogs within the selected course';
$string['reset_roles_local'] = 'Reset Local Roles';
$string['reset_roles_local_desc'] = 'Resets local roles within the selected course';
$string['reset_gradebook_items'] = 'Reset Gradebook Items';
$string['reset_gradebook_items_help'] = 'Resets all gradebook items within the selected course';
$string['reset_gradebook_grades'] = 'Reset Gradebook Grades';
$string['reset_gradebook_grades_help'] = 'Resets gradebook grades within the selected course';
$string['reset_groupings_remove'] = 'Remove Groupings';
$string['reset_groupings_remove_help'] = 'Yes: All Groupings you have set up for your module will be removed <br />
No: All Groupings you have set up for your module will be retained';
$string['reset_groupings_members'] = 'Reset Groupings Members';
$string['reset_groupings_members_desc'] = 'Resets all groupings members within the selected course';
$string['reset_groups_remove'] = 'Remove Groups';
$string['reset_groups_remove_help'] = 'Yes: All Groups you have set up for your module will be removed <br />
No: All Groups you have set up for your module will be retained';
$string['course_data'] = 'Allow Course Data';
$string['course_data_desc'] = 'Allow the user to edit the course data like shortname, fullnname, Description and idnumber';
$string['reset_roles'] = 'Reset Roles';
$string['reset_roles_desc'] = 'Allows the Course Administrator to reset role within their course';
$string['allow_backup'] = 'Allow Backup';
$string['allow_backup_desc'] = 'Allow Course Administrators to create a backup of their course before resetting';
$string['run_time'] = 'Run Time';
$string['run_time_desc'] = 'When should the Automatic Process run';
$string['unenrol_users'] = 'Roles';
$string['roles_desc'] = 'Select the roles you wish to unenrol during the rollover';

$string['reset_assignment_submissions'] = 'Reset Assignment Submissions';
$string['reset_assignment_submissions_desc'] = 'reset_assignment_submissions_desc';

$string['reset_forum_all'] = 'Reset Forum';
$string['reset_forum_all_desc'] = 'reset_freset_forum_all_descorum_all';

$string['reset_forum_subscriptions'] = 'Reset Forum Subscriptions';
$string['reset_forum_subscriptions_desc'] = 'reset_forum_subscriptions_desc';

$string['block_course_has_schedule'] = 'This course has been scheduled for a rollover on the {$a->scheduled_date}';
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
$string['db_prefix_desc'] = 'Enter a Prefix, Empty means no prefix';
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
$string['data_mapping_desc'] = 'Please enter the data mapping this data will be used to validate course information for new course and also auto populate the module code field';

$string['data_mapping_module_code'] = 'Module Code';
$string['data_mapping_module_code_desc'] = 'The Field that holds course Module Code (idnumber) in the external database';
$string['data_mapping_fullname'] = 'Course Title';
$string['data_mapping_fullname_desc'] = 'The Field that holds course Title in the external database';
$string['data_mapping_shortname'] = 'Course short Name';
$string['data_mapping_shortname_desc'] = 'The Field that holds course short name in the external database';
$string['data_mapping_summary'] = 'Course Description';
$string['data_mapping_summary_desc'] = 'The Field that holds course role description in the external database';
$string['data_mapping_course_id'] = 'Course ID';
$string['data_mapping_course_id_desc'] = 'The Field that holds course id in the external database';

$string['data_mapping_category'] = 'Course Category';
$string['data_mapping_category_desc'] = 'The Field that holds course Category in the external database';


$string['action_button_finished'] = 'Finished';
$string['confirm_reset'] = 'confirm reset';
// message string
$string['messageprovider:confirmation'] = 'Confirmation of your course rollover submissions';
$string['messageprovider:submission'] = 'Notification of course rollover submissions';


//email stuff
$string['emailconfirmsubject_update'] = 'Course Rollover Updated - {$a->coursename} ';
$string['emailconfirmbody_update'] = 'Dear {$a->username} , 
Your Course Rollover Schedule for QMplus module {$a->shortname} has now been Updated. 

Updated on : {$a->submitttedtime}.
Scheduled for : {$a->scheduledate}.

Best regards from the QMplus team';

$string['emailconfirmsubject_schedule'] = 'Course Rollover Scheduled for {$a->coursename} ';
$string['emailconfirmbody_schedule'] = 'Dear {$a->username},
Your Course Rollover for QMplus module {$a->shortname} has been Scheduled. 
Submitted on : {$a->submitttedtime}.
Scheduled for : {$a->scheduledate}. 


Best regards from the QMplus team';

$string['emailconfirmsubject_rollover'] = 'Course Rollover Complete for {$a->coursename} ';
$string['emailconfirmbody_rollover'] = 'Dear {$a->username}, 
Your QMplus module {$a->shortname} has now been reset. 

You can now start developing your module for the next academic year. Please check that your module information has been updated correctly and that it is hidden from student view. You can check this information in the settings area. 


Best regards from the QMplus team';


// Capabilities strings.
$string['course_rollover:view'] = 'View Course Rollover Block';
$string['course_rollover:manage'] = 'Manage Course Rollover Block';
$string['course_rollover:emailconfirmsubmission'] = 'Email Submission Confirm';

// Errors.
$string['error:no_course_to_rollover'] = 'No Course with this ID has been found';
$string['error:newerror'] = 'An error has occurred';
$string['error:mod_code_mixmatch'] = 'The Code you have selected does not match the current code. Are you sure you wish to continue ?';

