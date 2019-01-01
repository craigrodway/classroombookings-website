<?php namespace ProcessWire; ?>

<section class="section section-sm">

	<div class="container grid-sm">

		<div class="columns">

			<div class="column col-12">

				<header class="section-title section-title-mb">
					<h2><?= region('pageTitle') ?></h2>
					<p><?= $page->summary ?></p>
				</header>

			</div>

		</div>

	</div>


	<div class="container grid-sm">

		<div class="columns">

			<a class="column col-12 col-block bg-gray" href="<?= $current->link_url ?>">

				<div class="block-meta"><?= date('d M Y', $current->date) ?></div>

				<h3 class="block-title">
					<span class="block-icon text-clrs-green ?>"><?= feather('download') ?></span>
					<?= $current->title ?>
				</h3>
				<span class="label label-success">Latest</span>
				<?php
				if ($current->size_bytes) {
					$sizeStr = wireBytesStr($current->size_bytes);
					echo "<span class='label label-default'>{$sizeStr}</span>";
				}
				?>

				<div class="block-summary"><?= $current->body ?></div>

			</a>

			<div class="column col-12">
				<br>
				<div class="divider text-center" data-content="Previous versions"></div>
				<br>
			</div>

			<?php foreach ($releases as $release): ?>

			<?php if ($release->id == $current->id) continue; ?>

			<a class="column col-12 col-block" href="<?= $release->link_url ?>">

				<div class="block-meta"><?= date('d M Y', $release->date) ?></div>

				<h3 class="block-title">
					<span class="block-icon text-dark ?>"><?= feather('download') ?></span>
					<?= $release->title ?>
				</h3>

				<div class="block-summary"><?= $release->body ?></div>

			</a>

			<?php endforeach; ?>

		</div>

	</div>

</section>
