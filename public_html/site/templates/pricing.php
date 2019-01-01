<?php
namespace ProcessWire;

$view = [];

$view['options'] = $page->children("template=pricing-item");

region('content', wireRenderFile('views/pricing/pricing', $view));
