<?php

/**
 * since you can only return 1 array to the module, you have to wrap
 * the tabs in an inputfield wrapper
 */
$inputfields = new InputfieldWrapper();


/**
 * General settings
 *
 */
$general = [
	[
		'name' => 'site_name',
		'label' => __('Site Name'),
		'type' => 'InputfieldText',
		'value' => ''
	],
	[
		'name' => 'site_tagline',
		'label' => __('Site tagline'),
		'type' => 'InputfieldText',
		'value' => '',
	],
];


/**
 * Social media
 *
 */
$social = [
	[
		'name' => 'social_twitter',
		'label' => __('Twitter'),
		'type' => 'InputfieldURL',
		'value' => '',
		'description' => 'Full URL of profile, not just the @username.',
	],
	[
		'name' => 'social_facebook',
		'label' => __('Facebook'),
		'type' => 'InputfieldURL',
		'value' => '',
		'description' => 'Full URL of profile, not just the username.',
	],
];



/**
 * Finally add the tabs
 */

$tab = new InputfieldWrapper();
$tab->attr('title', 'General');
$tab->attr('class', 'WireTab');
$tab->add($general);
$inputfields->append($tab);


$tab = new InputfieldWrapper();
$tab->attr('title', 'Social Media');
$tab->attr('class', 'WireTab');
$tab->add($social);
$inputfields->append($tab);

//---------------------------------------------------


return $inputfields;
