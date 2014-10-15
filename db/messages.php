<?php

/****************************************************************

File:     /block/course_rollover/db/messages.php

Purpose:  Message provider

****************************************************************/

defined('MOODLE_INTERNAL') || die();

$messageproviders = array (
    // Notify user that a course_rolover has been requested this tells site Admin that the task has been requested
    'submission' => array (
		 'capability'  => 'block/course_rollover:emailnotify'
    ),
    // Confirm a course_rolover was done this tell theuser that a shedule has been created and when the task has ran
    // please note that the task may not run on the assigned day but will not run before the assigned day.
    'confirmation' => array (
		'capability'  => 'block/course_rollover:emailconfirm'
    )
);
?>
