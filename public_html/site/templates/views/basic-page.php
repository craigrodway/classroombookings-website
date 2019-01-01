<?php namespace ProcessWire; ?>

<section class="section section-sm">

	<div class="container grid-md">

		<header class="section-title section-title-mb">
			<h2><?= region('pageTitle') ?></h2>
			<p><?= $page->summary ?></p>
		</header>

	</div>

	<div class="container grid-md">
		<?= $page->body ?>
	</div>

</section>
