<?php namespace ProcessWire; ?>

<article class="section section-sm" itemscope="" itemtype="http://schema.org/CreativeWork">

	<div class="container grid-sm">

		<header class="section-title">
			<h1 itemprop="headline"><?= $page->get("headline|title") ?></h1>
			<p>
				<span itemprop="datePublished" datetime="<?= date('U', $page->getUnformatted('date')) ?>"><?= date('d M Y', $page->date) ?>.</span>
				<span><?= $page->summary ?></span>
			</p>

			<?php
			if ($page->topics->count() > 0) {
				echo renderNewsTopicList([
					'tagPages' => $page->topics,
					'title' => '',
					'showLatest' => false,
					'showPostCount' => false,
				]);
			}
			?>

		</header>

		<br><br>

		<div itemprop="text">
			<?= $page->body ?>
		</div>

	</div>

	<br><br>

</article>

