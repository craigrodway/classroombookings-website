<?php namespace ProcessWire; ?>

<section class="section section-sm">

	<div class="container grid-md">

		<header class="section-title section-title-mb">
			<h2><?= region('pageTitle') ?></h2>
			<p><?= $page->summary ?></p>
		</header>

	</div>

	<div class="container grid-md">
		<div class="columns">

			<?php foreach ($options as $item): ?>

			<div class="column col-pricing col-6 col-xs-12 col-sm-12">
				<div class="card card-pricing">
					<div class="card-header">
						<div class="card-title h3"><?= $item->title ?></div>
						<div class="card-subtitle text-gray"><?= $item->summary ?></div>
						<div class="card-price h6"><mark><?= $item->price ?></mark></div>
					</div>
					<div class="card-body">
						<?php
						foreach ($item->features as $feature) {
							echo "<dl>";
							echo feather($feature->icon_name);
							echo "<dt>{$feature->title}</dt>";
							if ($feature->summary) {
								echo "<dd>{$feature->summary}</dd>";
							}
							echo "</dl>";
						}
						?>
					</div>
					<div class="card-footer">
						<a href="<?= $item->link_url ?>" class="btn btn-primary"><?= $item->link_title ?></a>
					</div>
				</div>
			</div>

			<?php endforeach; ?>

		</div>
	</div>

</section>
