<?php namespace ProcessWire;


/**
 * URL to templates directory
 *
 * @param string $file		File path to append to returned path
 * @return string
 *
 */
function templatesUrl($file = '') {
	return urls('templates') . $file;
}




/**
 * Convert an email address to human-readable but entity-encoded characters to reduce chance of spam from crawlers.
 *
 * @param string $email 		Email address
 * @return string		Encoded version of $email
 *
 */
function protectEmail($email = '') {
	$email = str_replace('#', '', $email);
	$length = strlen($email);

	$obfuscatedEmail = '';
	for ($i = 0; $i < $length; $i++)
	{
		$obfuscatedEmail .= "&#" . ord($email[$i]) . ';';
	}

	return $obfuscatedEmail;
}


/**
 * Render a Feather icon string
 *
 * @param string $name		Name of icon to use
 * @param array $params		Extra params to use for SVG
 *
 */
function feather($name, $params = []) {
	return (string) wire('feathericons')->get($name, $params, false);
}


/**
 * Find the tags/topics used by pages
 *
 */
function findTopics($params = []) {

	$defaults = [
		'template' => 'news-post',
		'field' => 'topics'
	];

	$options = array_merge($defaults, $params);

	// Get tags that are used
	$template = templates($options['template']);
	$table = fields($options['field'])->getTable();

	$sql = "SELECT `data`
			FROM `{$table}`
			LEFT JOIN pages ON pages_id = pages.id
			WHERE pages.templates_id={$template->id}
			GROUP BY data";

	$query = database()->query($sql);
	$ids = $query->fetchAll(\PDO::FETCH_COLUMN);

	$tagPages = pages()->getById($ids);
	foreach ($tagPages as $tagPage) {
		$tagPage->postCount = pages()->count("template={$options['template']}, {$options['field']}={$tagPage}");
	}

	return $tagPages;
}

