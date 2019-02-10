<?php namespace ProcessWire;
$titleTag = region('pageTitle') . " | " . $settings->site_name;
if ($page == $pagecache->home) {
	$titleTag = $settings->site_name . " | " . $settings->site_tagline;
}

$meta['property']['og:title'] = region('pageTitle');
$meta['name']['twitter:title'] = region('pageTitle');

$cssBasePath = 'assets/';
$cssBaseName = 'crbs';
$cssFile = (config('env') == 'production' ? "{$cssBaseName}.min.css" : "{$cssBaseName}.css");
$cssPath = paths('templates') . $cssBasePath . $cssFile;
$cssUrl = templatesUrl($cssBasePath.$cssFile);
$cssUrl = $cssUrl.'?id='.filemtime($cssPath);

?><!DOCTYPE html>
<html lang="en">

	<head>
		<?php if (config('env') == 'production'): ?>
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
		<link rel="apple-touch-icon" sizes="180x180" href="/brand/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/brand/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/brand/favicon-16x16.png">
		<link rel="manifest" href="/brand/site.webmanifest">
		<link rel="mask-icon" href="/brand/safari-pinned-tab.svg" color="#ff6400">
		<link rel="shortcut icon" href="/brand/favicon.ico">
		<meta name="msapplication-TileColor" content="#ff6400">
		<meta name="msapplication-config" content="/brand/browserconfig.xml">
		<meta name="theme-color" content="#ff6400">
		<?php
		foreach ($meta as $prop => $items) {
			foreach ($items as $k => $v) {
				$v = strip_tags($v);
				echo "<meta {$prop}='{$k}' content='{$v}'>\n";
			}
		}
		?>
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

		<script>
		(function(f, a, t, h, o, m){
			a[h]=a[h]||function(){
				(a[h].q=a[h].q||[]).push(arguments)
			};
			o=f.createElement('script'),
			m=f.getElementsByTagName('script')[0];
			o.async=1; o.src=t; o.id='fathom-script';
			m.parentNode.insertBefore(o,m)
		})(document, window, '//fathom.onhover.co.uk/tracker.js', 'fathom');
		fathom('set', 'siteId', 'WSHIS');
		fathom('trackPageview');
		</script>

	</body>

</html>
