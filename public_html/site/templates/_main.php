<?php namespace ProcessWire;
$titleTag = region('pageTitle') . " | " . $pagecache->home->headline;
if ($page == $pagecache->home) {
	$titleTag = $pagecache->home->headline . " | " . $pagecache->home->summary;
}

$cssBasePath = 'assets/';
$cssBaseName = 'crbs';
$cssFile = (config('env') == 'production' ? "{$cssBaseName}.min.css" : "{$cssBaseName}.css");
$cssPath = paths('templates') . $cssBasePath . $cssFile;
$cssUrl = templatesUrl($cssBasePath.$cssFile);
$cssUrl = $cssUrl.'?id='.filemtime($cssPath);

?><!DOCTYPE html>
<html lang="en">

	<head>
		<?php if ($config->environment == 'production'): ?>
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-3041463-3"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-3041463-3');
		</script>
		<?php endif; ?>
		<title><?= $titleTag ?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<meta name="robots" content="index, follow">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="<?= region('description') ?>">
		<meta name="author" content="Craig A Rodway">
		<link href="<?= $cssUrl ?>" rel="stylesheet" type="text/css">
	</head>

	<body>

		<div class="off-canvas">

			<div id="sidebar" class="off-canvas-sidebar">
				<?php echo renderSubmenu([
					'ulClass' => 'nav-sidebar',
					'labelAttr' => 'title',
					'items' => $pagecache->home->children()->prepend($pagecache->home),
				]);
				?>
			</div>

			<a class="off-canvas-overlay" href="#close"></a>

			<div class="off-canvas-content">
				<div class="page">
					<?php require_once("./includes/sections/header.php"); ?>
					<?= region('content'); ?>
				</div>
				<?php require_once("./includes/sections/footer.php"); ?>
			</div>

		</div>

	</body>

</html>
