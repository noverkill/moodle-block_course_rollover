<?php

/****************************************************************

File:     /block/course_rollover/db/upgrade.php

Purpose:  Upgrade script for course rollover

****************************************************************/

function xmldb_block_course_rollover_upgrade($oldversion = 0)
{
    global $CFG, $DB;
	$dbman = $DB->get_manager();
    if ($oldversion < 2013051901) {

        // Define table course_rollover to be created
        $table = new xmldb_table('block_course_rollover');

	    // Adding fields to table block_course_rollover
	    $table->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
	    $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
	    $table->add_field('courseid', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
	    $table->add_field('idnumber', XMLDB_TYPE_CHAR, '100', null, null, null, null);
	    $table->add_field('shortname', XMLDB_TYPE_CHAR, '254', null, null, null, null);
	    $table->add_field('summary', XMLDB_TYPE_TEXT, 'small', null, null, null, null);
	    $table->add_field('scheduletime', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
	    $table->add_field('course_reset_data', XMLDB_TYPE_TEXT, 'small', null, null, null, null);
	    $table->add_field('modcode', XMLDB_TYPE_CHAR, '100', null, null, null, null);
	    $table->add_field('status', XMLDB_TYPE_INTEGER, '3', null, null, null, '200');

	    // Adding keys to table block_course_rollover
	    $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

	    // Adding indexes to table block_course_rollover
	    $table->add_index('course_rollover_course_ix', XMLDB_INDEX_UNIQUE, array('courseid'));
	    $table->add_index('course_rollover_user_ix', XMLDB_INDEX_NOTUNIQUE, array('userid'));
	    $table->add_index('course_rollover_idnumb_ix', XMLDB_INDEX_NOTUNIQUE, array('idnumber'));

	    // Conditionally launch create table for block_course_rollover
	    if(!$dbman->table_exists($table)) {
			$dbman->create_table($table);
	    }


        // course_rollover savepoint reached
        upgrade_block_savepoint(true, 2013051901, 'course_rollover');
    }
}
