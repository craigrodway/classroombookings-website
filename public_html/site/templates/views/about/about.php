<?php namespace ProcessWire; ?>

<section class="section section-sm">

	<div class="container grid-sm">

		<header class="section-title section-title-mb">
			<h2><?= region('pageTitle') ?></h2>
			<p><?= $page->summary ?></p>
		</header>

	</div>

	<div class="about-body">
		<?php
		if ( ! empty($page->body)) {
			echo "<div class='container grid-sm'>{$page->body}</div>";
		} else {
			foreach ($page->content as $block) {
				echo "<div class='container grid-{$block->grid_size->value}'>";
				echo $block->body;
				echo "</div>";
			}
		}
		?>
	</div>

</section>
