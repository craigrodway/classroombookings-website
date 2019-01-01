<?php
namespace ProcessWire;


function renderNavItems($params = []) {

	$defaults = [
		'items' => new PageArray(),
	];

	$options = array_merge($defaults, $params);
	extract($options);

	if (empty($items) || $items->count() == 0) {
		return '';
	}

	$out = '';

	foreach ($items as $item) {

		$classes = 'btn btn-link';

		// render markup for each navigation item as an <li>
		if ($item->id == wire('page')->id || $item->id == wire('page')->rootParent->id) {
			// if current item is the same as the page being viewed, add a "current" class to it
			$classes .= ' btn-active';
		}

		$out .= "<a href='{$item->url}' class='{$classes}'>{$item->title}</a>\n";
	}

	return $out;

}


function renderBreadcrumbs($crumbs = null) {

	$out = '';

	if ($crumbs === null) {

		$crumbs = new Breadcrumbs();
		$page = wire('page');
		$parents = $page->parents;

		if ($parents->count() > 0) {
			foreach ($parents as $parent) {
				$url = $parent->url;
				if ($parent->id == 1) {
					$title = $parent->title;
				} else {
					$title = $parent->get('headline|title');
				}
				$crumbs->add(new Breadcrumb($url, $title));
			}
		}

		// Current page
		$crumbs->add(new Breadcrumb($page->url, $page->get('headline|title')));
	}

	if (empty($crumbs)) {
		return '';
	}

	$out .= "<ul class='breadcrumb'>";

	// $lastItem = $crumbs->pop();

	foreach ($crumbs as $item) {
		$out .= "<li class='breadcrumb-item'><a href='{$item->url}'>{$item->title}</a></li>";
	}

	// $out .= "<li class='breadcrumb-item'><a hre{$lastItem->title}</li>";

	$out .= "</ul>";

	return $out;

}


function renderTestimonials() {

	$testimonialsPage = pages()->get("template=testimonials");
	$testimonials = $testimonialsPage->children("template=testimonial");

	return wireRenderFile('partials/testimonials', [
		'testimonials' => $testimonials,
	]);
}


function renderBenefits() {

	$benefitsPage = pages()->get("template=benefits");
	$benefits = $benefitsPage->children("template=benefit");

	return wireRenderFile('partials/benefits', [
		'benefits' => $benefits,
	]);
}


/**
 * Render the tags menu
 *
 * @param array $params
 * 	title: Optional title (pure-menu-heading) to show
 * 	showLatest: Whether or not to include the "latest" item which goes to `newsPage`
 * 	latestTitle: Label to use for linking to `newsPage`
 * 	tagPages: PageArray of tags to show
 * 	newsPage: Page where the main news is
 * 	navClass: Extra classes string for the main <nav> pure-menu element.
 *
 * @return  string markup from partials/blog-tag-list
 *
 */
function renderNewsTopicList($params = []) {

	$defaults = [
		'title' => '',
		'showLatest' => false,
		'showPostCount' => true,
		'latestTitle' => 'Latest',
		'tagPages' => findTopics(),
		'newsPage' => wire('pagecache')->news,
		'navClass' => '',
	];

	$options = array_merge($defaults, $params);

	return wireRenderFile('partials/news-topic-list', $options);
}




function renderSubmenu($params = []) {

	$defaults = [
		'items' => new PageArray(),
		'title' => '',
		'labelAttr' => 'headline|title',
		'ulClass' => '',
		'liClass' => '',
		'icon' => '',
	];

	$options = array_merge($defaults, $params);
	extract($options);

	if (empty($items) || $items->count() == 0) {
		return '';
	}

	$out = '';

	$out .= "<ul class='nav {$ulClass}'>";

	if ( ! empty($title)) {
		$out .= "<li class='divider' data-content='{$title}'></li>";
	}

	foreach ($items as $item) {

		$extraClasses = '';

		// render markup for each navigation item as an <li>
		if ($item->id == wire('page')->id || $item->id == wire('page')->rootParent->id) {
			// if current item is the same as the page being viewed, add a "current" class to it
			$extraClasses .= ' is-selected';
		}

		$iconEl = (strlen($icon) ? feather('chevron-right') : '');
		$labelText = $item->get($labelAttr);
		$link = "<a href='{$item->url}'>{$labelText}</a>";
		$liItem = "<li class='nav-item {$liClass} {$extraClasses}'>{$iconEl}{$link}</li>";

		$out .= "{$liItem}\n";
	}

	$out .= "</ul>";

	return $out;
}
