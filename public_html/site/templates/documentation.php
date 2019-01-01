<?php
namespace ProcessWire;

$view = [];

if ($page->hasChildren()) {

	$menuOptions = [
		'ulClass' => 'nav-docs',
		'items' => $page->children(),
		'title' => $page->get("headline|title"),
		'icon' => 'chevron-right',
	];

	$body = wireRenderFile('views/documentation/index');

} else {

	$menuOptions = [
		'ulClass' => 'nav-docs',
		'items' => $page->parent()->children(),
		'title' => $page->parent()->get("headline|title"),
		'icon' => 'chevron-right',
	];

	$body = $page->body;

}

$view['sidebar'] = renderSubmenu($menuOptions);
$view['body'] = $body;

region('content', wireRenderFile('views/documentation/documentation', $view));
