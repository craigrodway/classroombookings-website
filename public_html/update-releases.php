<?php
namespace ProcessWire;

require("./index.php");

if ( ! $config->cli) {
	if (wire('input')->key !== config('update_key')) {
		exit("Key error");
	}
}

$releases = wire('modules')->get('Releases');
$result = $releases->refresh();

wire('input')->post->clearCache = 1;
$pageRender = wire('modules')->get('PageRender');
$pageRender->getModuleConfigInputfields(array());

echo "OK";
