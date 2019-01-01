<?php
namespace ProcessWire;
?>

<div class="columns">

	<?php foreach ($benefits as $benefit): ?>

	<div class="column col-xs-12 col-sm-12 col-6 col-feature">
		<span class="feature-icon <?= $benefit->colour->value ?>">
			<?= feather($benefit->icon_name) ?>
		</span>
		<h5><?= $benefit->title ?></h5>
		<?= $benefit->body ?>
	</div>

	<?php endforeach; ?>

</div>
