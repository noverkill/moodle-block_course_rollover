<?php

/****************************************************************

File:       block/module_info/version.php

Purpose:    This file holds version information for the plugin,
            along with other advanced parameters like object field
            definitions that denote the version number of the block,
            and the minimum version of Moodle that must be
            installed in order to use this plugin.
			These parameters are used during the plugin installation
			and upgrade process to make sure that the
			plugin is compatible with the given Moodle site, as well
			as spotting whether an upgrade is needed.

****************************************************************/

// No direct script access.
defined('MOODLE_INTERNAL') || die();

$plugin->version   	= 2013051901;                // The current plugin version (Date: YYYYMMDDXX).
$plugin->requires  	= 2011112900;                // Requires this Moodle version.
$plugin->component 	= 'block_course_rollover';   // Full name of the plugin (used for diagnostics).
$plugin->cron		= 100;
