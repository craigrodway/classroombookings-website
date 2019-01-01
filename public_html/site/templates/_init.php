<?php
namespace ProcessWire;

// Use the main template - yes!
$useMain = true;

// Default layout
$layout = 'default';


// Include shared functions
include_once("./_helper.php");
include_once("./_render.php");

// Set up regions
region('pageTitle', $page->get('headline|title'));
region('subtitle', $page->summary);
region('content', $page->body);
region('breadcrumbs', renderBreadcrumbs());

if ($page == $pagecache->home) {
	region('titleTag', $settings->site_name . ' | ' . $pagecache->home->summary);
} else {
	region('titleTag', region('pageTitle') . ' | ' . $settings->site_name);
}
// include_once("./_structured_data.php");


// OpenGraph/Twitter Cards
/*$meta = [];
$meta['property'] = array(
	'og:title' => region('pageTitle'),
	'og:site_name' => $settings->site_name,
	'og:url' => $page->httpUrl,
	'og:description' => $settings->site_tagline,
	'og:type' => 'website',
);
$meta['name'] = array();*/
