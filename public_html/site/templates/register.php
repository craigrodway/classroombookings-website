<?php
namespace ProcessWire;

require_once("./_forms.php");

$status = processRegisterForm();

if ($status && $status['success']) {
	wire('session')->redirect($page->url . 'success/');
}

$view = [
	'status' => $status,
];

if (wire('input')->urlSegment(1) == 'success') {
	region('pageTitle', 'Registration complete');
	$page->summary = '';
	$viewName = 'views/register/success';
} else {
	$viewName = 'views/register/form';
}

region('content', wireRenderFile($viewName, $view));
