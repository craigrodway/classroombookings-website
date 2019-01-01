<?php
namespace ProcessWire;

$view = [];

$view['current'] = $page->current_release;
$view['releases'] = $page->children("template=release, sort=-date");

region('content', wireRenderFile('views/downloads/downloads', $view));
