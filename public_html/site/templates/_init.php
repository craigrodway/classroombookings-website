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
$meta = [];
$meta['property'] = array(
	'og:type' => 'website',
	'og:site_name' => $settings->site_name,
	'og:url' => $page->httpUrl,
	'og:description' => $page->get('summary|headline'),
	'og:image' => rtrim($pagecache->home->httpUrl, '/').templatesUrl('assets/img/crbs-logo-white.png'),
);
$meta['name'] = array(
	'twitter:card' => 'summary',
	'twitter:description' => $page->get('summary|headline'),
	'twitter:url' => $page->httpUrl,
	'twitter:image' => rtrim($pagecache->home->httpUrl, '/').templatesUrl('assets/img/crbs-logo-white.png'),
);
