<?php namespace ProcessWire; ?>

<section class="section section-sm">

	<div class="container grid-sm">

		<header class="section-title section-title-mb">
			<h2><?= region('pageTitle') ?></h2>
			<p><?= $page->summary ?></p>
		</header>

		<div class="toast toast-success">
			<p>Thanks! Your request has been received and will be actioned as soon as possible.</p><p>You will be sent an email containing instructions on how to access your installation once it has been set up.</p>
		</div>

	</div>

</section>
