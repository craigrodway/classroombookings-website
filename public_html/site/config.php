<?php namespace ProcessWire;

/**
 * ProcessWire Configuration File
 *
 * Site-specific configuration for ProcessWire
 *
 * Please see the file /wire/config.php which contains all configuration options you may
 * specify here. Simply copy any of the configuration options from that file and paste
 * them into this file in order to modify them.
 *
 * SECURITY NOTICE
 * In non-dedicated environments, you should lock down the permissions of this file so
 * that it cannot be seen by other users on the system. For more information, please
 * see the config.php section at: https://processwire.com/docs/security/file-permissions/
 *
 * This file is licensed under the MIT license
 * https://processwire.com/about/license/mit/
 *
 * ProcessWire 3.x, Copyright 2016 by Ryan Cramer
 * https://processwire.com
 *
 */

if(!defined("PROCESSWIRE")) die();

/*** SITE CONFIG *************************************************************************/

/** @var Config $config */

/**
 * Enable debug mode?
 *
 * Debug mode causes additional info to appear for use during dev and debugging.
 * This is almost always recommended for sites in development. However, you should
 * always have this disabled for live/production sites.
 *
 * @var bool
 *
 */
$config->debug = false;

/**
 * Prepend template file
 *
 * PHP file in /site/templates/ that will be loaded before each page's template file.
 * Example: _init.php
 *
 * @var string
 *
 */
$config->prependTemplateFile = '_init.php';

/**
 * Append template file
 *
 * PHP file in /site/templates/ that will be loaded after each page's template file.
 * Example: _main.php
 *
 * @var string
 *
 */
$config->appendTemplateFile = '_main.php';


/**
 * Installer: User Authentication Salt
 *
 * Must be retained if you migrate your site from one server to another
 *
 */
$config->userAuthSalt = '54f03b0afa8e06df14187dcba93b7b9f';


/**
 * Installer: File Permission Configuration
 *
 */
$config->chmodDir = '0755'; // permission for directories created by ProcessWire
$config->chmodFile = '0644'; // permission for files created by ProcessWire


/**
 * Installer: Time zone setting
 *
 */
$config->timezone = 'Europe/London';


/**
 * Installer: Admin theme
 *
 */
$config->defaultAdminTheme = 'AdminThemeUikit';


/**
 * Installer: Unix timestamp of date/time installed
 *
 * This is used to detect which when certain behaviors must be backwards compatible.
 * Please leave this value as-is.
 *
 */
$config->installed = 1545863478;


/**
 * Enable advanced mode in dev
 *
 */
$config->advanced = false;


/**
 * Use Functions API
 *
 */
$config->useFunctionsAPI = true;


/**
 * Default to production environment
 *
 */
$config->env = 'production';


/**
 * Secret key for URL-based updates to releases
 *
 */
$config->update_key = 'changeme';


/**
 * Global pagination settings
 *
 */
$config->pagination = array(
	'limit' => 6,		// limit is not used by pager markup module, but for our own purposes when retrieving content
	'numPageLinks' => 10,
	'nextItemLabel' => "Next",
	'previousItemLabel' => "Previous",
	'listMarkup' => "<ul class='pagination'>{out}</ul>",
	'itemMarkup' => "<li class='page-item {class}'>{out}</li>",
	'linkMarkup' => "<a href='{url}'>{out}</a>",
	'currentLinkMarkup' => "<a href='{url}'>{out}</a>",
	'currentItemClass' => 'active',
	'nextItemClass' => 'is-nextprev',
	'previousItemClass' => 'is-nextprev',
);


// Environment overwrite
if (is_file(__DIR__ . '/config.local.php')) {
	require_once(__DIR__ . '/config.local.php');
}

