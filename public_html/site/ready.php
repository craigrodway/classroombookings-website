<?php namespace ProcessWire;


/**
 * Initialiase the pagecache.
 *
 * This sets up a PW object which has references to commonly-used pages.
 *
 */
$pagecache = new WireData();

$pagecache->set('home', $this->wire('pages')->get('/'));
$pagecache->set('news', $this->wire('pages')->get('template=news'));
$pagecache->set('about', $this->wire('pages')->get('template=about, name=about, include=all'));

$this->wire('pagecache', $pagecache, true);


/**
 * Register feather icons var
 *
 */
$featherIcons = new \Feather\Icons();
$this->wire('feathericons', $featherIcons, true);


/**
 * Initialise the global variable for settings
 *
 */
$this->wire('settings', $modules->get('SettingsFactory')->getSettings('settings'), true);



/**
 * Prevent template caching when $config->disableTemplateCache is set to `true`.
 *
 */
$this->addHookBefore('Page::render', null, function($event) {
	 if (wire('config')->disableTemplateCache) {
		$args = $event->arguments(1);
		$args['allowCache'] = false;
		$event->setArgument(1, $args);
	}
});
