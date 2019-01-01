<?php namespace ProcessWire; ?>

<section class="section section-sm">

	<div class="container grid-md">

		<header class="section-title section-title-mb">
			<h2><?= region('pageTitle') ?></h2>
			<p>Keep up to date with new features, fixes and releases.</p>
		</header>

	</div>

	<div class="container grid-md">

		<?= $topicList ?>
		<br><br>

		<div class="columns">

			<?php foreach ($posts as $post): ?>

			<a class="column col-6 col-xs-12 col-sm-12 col-block" href="<?= $post->url ?>">

				<?php
				$icon_name = ($post->icon_name ? $post->icon_name : $post->topics->first()->icon_name);
				$style_name = ($post->colour->value ? $post->colour->value : $post->topics->first()->colour->value);
				?>

				<div class="block-meta"><?= date('d M Y', $post->date) ?></div>

				<h3 class="block-title">
					<span class="block-icon <?= $style_name ?>"><?= feather($icon_name) ?></span>
					<?= $post->title ?>
				</h3>


				<p class="block-summary"><?= $post->summary ?></p>
			</a>

			<?php endforeach; ?>

		</div>

	</div>

	<div class="container grid-md">
		<?= $pager ?>
	</div>

</section>
