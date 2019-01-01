<?php
namespace ProcessWire;

$viewName = 'views/basic-page';
if ($page->name == 'http404') {
	$viewName = 'views/http404';
}

region('content', wireRenderFile($viewName));
