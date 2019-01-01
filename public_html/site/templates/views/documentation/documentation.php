<?php namespace ProcessWire; ?>

<section class="section section-sm">

	<div class="container grid-xl">

		<div class="columns">

			<aside class="column col-3 col-xs-12 col-sm-12">
				<?= $sidebar ?>
			</aside>

			<section class="column col-9 col-xs-12 col-sm-12">

				<header class="section-title section-title-mb">
					<h2><?= region('pageTitle') ?></h2>
					<p><?= $page->summary ?></p>
				</header>

				<div class="documentation-body"><?= $body ?></div>

			</section>

		</div>

	</div>

</section>
