<?php
namespace ProcessWire;
?>

<div class="columns">

	<?php foreach ($testimonials as $testimonial): ?>

	<div class="column col-xs-12 col-lg-6 col-xl-3">
		<blockquote class="quote-testimonial">
			<p><?= $testimonial->summary ?></p>
			<cite><?= $testimonial->title ?></cite>
		</blockquote>
	</div>

	<?php endforeach; ?>

</div>
