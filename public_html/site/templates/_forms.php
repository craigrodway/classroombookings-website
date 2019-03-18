<?php
namespace ProcessWire;

function processRegisterForm() {

	$input = wire('input');
	$session = wire('session');
	$sanitizer = wire('sanitizer');
	$notices = wire('notices');
	$emailTo = config('registerEmailTo');

	$siteTitle = wire('settings')->site_name;

	// Check if form was submitted
	if ( ! $input->post($session->CSRF->getTokenName())) {
		return [
			'error' => false,
			'sent' => false,
			'reason' => 'no_form',
		];
	}


	// Generate our unique ID for the submission so we can save a copy internally (using cache)
	$msgId = date("YmdHis").'.'.uniqid();

	// Encode the message for the internal storage
	$msgEncoded = json_encode([
		'ip' => $session->getIP(),
		'ua' => $_SERVER['HTTP_USER_AGENT'],
		'dt' => date('Y-m-d H:i:s'),
		'post' => $_POST,
	], JSON_NUMERIC_CHECK);

	$cache = new WireCache();

	// Check security of the submission
	try {
		$session->CSRF->validate();
	} catch (Exception $e) {
		return [
			'error' => true,
			'reason' => 'csrf',
			'message' => "Sorry, your form submission could not be validated.",
		];
	}

	$session->CSRF->resetToken();

	$spamFields = array('name', 'email', 'comments');
	$spamValue = '';
	foreach ($spamFields as $field) {
		$spamValue .= trim($input->post($field));
	}

	// Was the submission suspicious?
	if ( ! empty($spamValue)) {
		// SPAM!
		$cache->save("form.register.spam.{$msgId}", $msgEncoded, WireCache::expireMonthly);
		return [
			'error' => true,
			'reason' => 'spam',
			'message' => "Sorry, your form values looked like spam.",
		];
	}

	$formData = new WireData();

	// Names of the actual data fields (reversed to reduce spam)
	$fields = [
		'name',
		'email',
		'school',
		'subdomain',
		'comments',
	];

	foreach ($fields as $field) {
		$postField = strrev($field);
		$formData->set($field, trim($input->post($postField)));
	}

	// Sanitise things
	$formData->name = $sanitizer->text($formData->name);
	$formData->email = $sanitizer->email(strtolower($formData->email));
	$formData->school = $sanitizer->text($formData->school);
	$formData->subdomain = $sanitizer->text($formData->subdomain);
	$formData->comments = $sanitizer->textarea($formData->comments);

	// Update the whitelist with our clean values
	foreach ($fields as $field) {
		$input->whitelist($field, $formData->$field);
	}

	// Validate the fields

	if (empty($formData->name) || empty($formData->email) || empty($formData->school)) {
		return [
			'error' => true,
			'reason' => 'validation',
			'message' => "Please complete the required fields and try again.",
		];
	}

	// Good to go!

	// Save the data locally
	$cache->save("form.register.genuine.{$msgId}", $msgEncoded, WireCache::expireNever);

	$emailStatus = sendEmail($msgId, $formData);
	$trelloStatus = sendToTrello($formData);

	if ($emailStatus || $trelloStatus) {
		return [
			'error' => false,
			'success' => true,
			'email' => $emailStatus,
			'trello' => $trelloStatus,
		];
	}

	return [
		'error' => true,
		'success' => false,
		'reason' => 'mail',
		'email' => $emailStatus,
		'trello' => $trelloStatus,
		'message' => 'Sorry, there was an error processing your request.',
	];
}


function sendEmail($msgId, $formData) {

	// Build message content in different formats
	$text = wireRenderFile('emails/register/text', array(
		'formData' => $formData,
		'msgId' => $msgId,
	));

	$html = wireRenderFile('emails/register/html', array(
		'formData' => $formData,
		'msgId' => $msgId,
	));

	// Send
	$mail = wireMail();

	$mail->to(wire('config')->registerRcpt);
	// $mail->from("{$formData->name} <{$formData->email}>");
	$mail->subject("classroombookings Hosted ({$formData->school})");
	$mail->header("Reply-To", "{$formData->name} <{$formData->email}>");
	$mail->header("X-Reply-To", "{$formData->name} <{$formData->email}>");
	$mail->header("X-Mailer", "classroombookings/Processwire-PHP/" . phpversion());
	$mail->body($text);
	$mail->bodyHTML($html);

	$sent = $mail->send();
	return $sent;
}



function sendToTrello($formData) {

	$body = "**Name:** {$formData->name}\r\n";
	$body .= "**Email:** {$formData->email}\r\n";
	$body .= "**Subdomain:** {$formData->subdomain}\r\n";
	$body .= "\n\n**Comments:**\r\n\r\n{$formData->comments}";

	$mail = wireMail();

	$mail->to(wire('config')->registerTrelloRcpt);
	// $mail->from("{$formData->name} <{$formData->email}>");
	$mail->subject("{$formData->school}");
	$mail->header("X-Mailer", "classroombookings/Processwire-PHP/" . phpversion());
	$mail->body($body);

	$sent = $mail->send();
	return $sent;
}
