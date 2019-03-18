<!doctype html>
<html>
	<head>
		<meta name="charset" content="utf-8">
	</head>
	<body>
		<div class="info">
			<h5>Name</h5>
			<p><?php echo $sanitizer->entities($formData->name) ?></p>

			<h5>Email address</h5>
			<p><a href="mailto:<?php echo $sanitizer->entities($formData->email); ?>"><?php echo $sanitizer->entities($formData->email); ?></a></p>

			<h5>School</h5>
			<p><?php echo $sanitizer->entities($formData->school) ?></p>

			<h5>Subdomain</h5>
			<p><?php echo $sanitizer->entities($formData->subdomain) ?></p>
		</div>

		<hr>

		<div class="message">
			<h2>Comments</h2>
			<p><?php echo nl2br($formData->comments, false); ?></p>
		</div>

		<hr>

		<p><small>System ID <?php echo $msgId ?></small></p>

	</body>
</html>
