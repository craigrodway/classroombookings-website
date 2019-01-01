<?php
namespace ProcessWire;

$view = [
	'newsPage' => $pagecache->news,
];

region('content', wireRenderFile('views/news/post', $view));
