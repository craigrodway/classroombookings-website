<?php namespace ProcessWire; ?>

<header class="header">

	<div class="container grid-xl">
		<div class="columns">
			<div class="column col-12">
				<div class="navbar">
					<section class="navbar-section show-md">
						<a class="off-canvas-toggle btn btn-primary btn-action show-md" href="#sidebar">
							<?= feather('menu') ?>
						</a>
					</section>
					<section class="navbar-section">
						<a href="<?= $pagecache->home->url ?>" class="logo-link d-inline-block">
							<img class="img-logo" src="<?= templatesUrl('assets/img/crbs-logo.png') ?>">
						</a>
					</section>
					<section class="navbar-section hide-md">
						<?php
						echo renderNavItems([
							'items' => $pagecache->home->children(),
						]);
						?>
					</section>
				</div>
			</div>
		</div>
	</div>

</header>

<?php if ($page !== $pagecache->home): ?>

<section class="section section-xs section-bt">
	<div class="container grid-xl">
		<?php
		if (region('breadcrumbs')) {
			echo region('breadcrumbs');
		}
		?>
	</div>
</section>

<?php endif; ?>

