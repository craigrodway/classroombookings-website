<?php namespace ProcessWire; ?>

<section class="section section-sm">

	<div class="container grid-sm">

		<header class="section-title section-title-mb">
			<h2><?= region('pageTitle') ?></h2>
			<p><?= $page->summary ?></p>
		</header>

		<?php
		if ($status && $status['error'] && $status['reason'] !== 'no_form') {
			echo "<div class='toast toast-error'>";
			echo $status['message'];
			echo "</div>";
			echo "<br><br>";
		}
		?>

		<p>Complete the fields in the form below. All requests are processed manually, so please allow a short time for it to be actioned.</p>
		<p>Once your installation is ready, you will have full access to try it out and use it for 14 days.</p>
		<p>If you have any questions, please email <strong><a href="mailto:<?= protectEmail('craig@classroombookings.com') ?>"><?= protectEmail('craig@classroombookings.com') ?></a></strong>.</p>

		<div class="toast toast-info">
			<h3 class='h6'>Payment information</h3>
				<ul>
					<li>Currently priced at &pound;66 a year.</li>
					<li>Payment can be made by bank transfer or Direct Debit.</li>
					<li>There is a &pound;4 charge for paying by cheque.</li>
					<li>Purchase Orders are accepted.</li>
				</p>
			</ul>
		</div>

		<br>
		<div class="divider"></div>
		<br>


		<form method="post" action="<?= $page->url ?>">

			<div class="fill-this-in">
				<input type="text" name="name">
				<input type="email" name="email">
				<textarea name="comments"></textarea>
			</div>

			<input type="hidden" name="<?php echo $session->CSRF->getTokenName(); ?>" value="<?php echo $session->CSRF->getTokenValue(); ?>" >

			<?php
			$field = strrev('name');
			$value = htmlentities($input->whitelist(strrev($field)));
			?>
			<div class="form-group">
				<label class="form-label" for="<?= $field ?>">Your name</label>
				<div class="col-6">
					<input class="form-input" type="text" id="<?= $field ?>" name="<?= $field ?>" value="<?= $value ?>">
				</div>
			</div>

			<?php
			$field = strrev('email');
			$value = htmlentities($input->whitelist(strrev($field)));
			?>
			<div class="form-group">
				<label class="form-label" for="<?= $field ?>">Your email address</label>
				<span class="form-hint">This will only be used to get in touch about the service. Never spammed, never given to third parties.</span>
				<div class="col-8">
					<input class="form-input" type="email" id="<?= $field ?>" name="<?= $field ?>" value="<?= $value ?>">
				</div>
			</div>


			<?php
			$field = strrev('school');
			$value = htmlentities($input->whitelist(strrev($field)));
			?>
			<div class="form-group">
				<label class="form-label" for="<?= $field ?>">Your school name</label>
				<div class="col-8">
					<input class="form-input" type="text" id="<?= $field ?>" name="<?= $field ?>" value="<?= $value ?>">
				</div>
			</div>


			<?php
			$field = strrev('subdomain');
			$value = htmlentities($input->whitelist(strrev($field)));
			?>
			<div class="form-group">
				<label class="form-label" for="<?= $field ?>">Preferred subdomain</label>
				<span class="form-hint">This is the web address that will be used to access your classroombookings installation. Letters, numbers and hyphens only.</span>
				<div class="input-group col-6">
					<input class="form-input" type="text" id="<?= $field ?>" name="<?= $field ?>" value="<?= $value ?>">
					<span class="input-group-addon">.crbsapp.co.uk</span>
				</div>
			</div>

			<?php
			$field = strrev('comments');
			$value = htmlentities($input->whitelist(strrev($field)));
			?>
			<div class="form-group">
				<label class="form-label" for="<?= $field ?>">Any questions, comments or feedback?</label>
				<div class="col-8">
					<textarea class="form-input" rows="5" id="<?= $field ?>" name="<?= $field ?>"><?= $value ?></textarea>
				</div>
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Submit</button>
			</div>

		</form>

	</div>

</section>
