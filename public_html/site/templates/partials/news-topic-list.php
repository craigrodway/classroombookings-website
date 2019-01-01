<?php namespace ProcessWire; ?>

<!-- <nav class="pure-menu pure-menu-horizontal blog-tag-menu <?= $navClass ?>"> -->

<nav class="topic-list">

	<?php if (isset($title) && strlen($title)): ?>
	<span class="pure-menu-heading"><?= $title ?></span>
	<?php endif; ?>

	<!-- <ul class="pure-menu-list"> -->

		<?php
		if ($showLatest) {
			$classes = (page() == $newsPage ? 'chip-selected' : '');
			echo "<a href='{$newsPage->url}' class='chip chip-topic {$classes}'>{$latestTitle}</a> ";
		}

		foreach ($tagPages as $tagPage) {
			$count = '';
			if ($showPostCount) {
				$count = "<figure class='avatar avatar-sm' data-initial='{$tagPage->postCount}' ></figure>";
			}
			$classes = (page() == $tagPage ? 'chip-selected' : '');
			echo "<a href='{$tagPage->url}' class='chip chip-topic {$classes}'>{$count}{$tagPage->title}</a> ";
		}
		?>

	<!-- </ul> -->

</nav>
