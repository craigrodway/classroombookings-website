<?php namespace ProcessWire; ?>

<dl class="docs-list">

<?php foreach ($page->children() as $item): ?>

	<dt><a href="<?= $item->url ?>"><?= $item->get("headline|title") ?></a></dt>
	<dd><?= $item->summary ?></dd>

<?php endforeach; ?>

</dl>
