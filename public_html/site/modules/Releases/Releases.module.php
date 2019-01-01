<?php namespace ProcessWire;

class Releases extends WireData implements Module
{


	public static function getModuleInfo() {

		return array(
			'title' => 'Releases',
			'version' => 1,
			'summary' => 'Sync classroombookings releases at GitHub to local pages.',
			'singular' => true,
			'autoload' => false,
			'icon' => 'github',
		);
	}


	/**
	 * API URL to repo
	 *
	 */
	const API_URL  = 'https://api.github.com/repos/craigrodway/classroombookings/releases';


	/**
	 * Name to use in cache
	 *
	 */
	const CACHE_NAME = 'releases';


	/**
	 * Template name for each release.
	 *
	 */
	const TEMPLATE_NAME = 'release';


	/**
	 * Selector to get parent page for releases.
	 *
	 */
	const PARENT_SELECTOR = 'template=downloads';


	/**
	 * Initialize the module
	 *
	 * ProcessWire calls this when the module is loaded.
	 *
	 */
	public function init() {}


	/**
	 * Run all the things.
	 *
	 * - Get release data
	 * - Process release data to update pages.
	 *
	 */
	public function refresh() {

		$releases = $this->getReleases();

		if (empty($releases)) {
			return null;
		}

		foreach ($releases as $rel) {
			$this->processRelease($rel);
		}

		$this->updateLatest();

		return true;
	}


	/**
	 * Get release information.
	 *
	 * If not in cache, or cached result is empty, get fresh data.
	 * On fresh data, put in cache + return.
	 *
	 * @return  mixed		Array or null
	 *
	 */
	private function getReleases() {

		$res = $this->cache->get(self::CACHE_NAME);

		if ( ! empty($res)) {
			return $res;
		}

		$http = new WireHttp();
		$response = $http->getJSON(self::API_URL);

		$releases = [];

		if ($response !== false) {

			foreach ($response as $release) {
				$release['assets'] = $this->getAssets($release['assets_url']);
				$releases[] = $release;
			}

			$this->cache->save(self::CACHE_NAME, $releases, WireCache::expireHourly);
			return $releases;

		} else {

			$this->wire('log')->save("releases", "Error: " . $http->getError());
			return null;

		}

		return null;
	}


	/**
	 * Process a specific release from the source data and create/update the local pages.
	 *
	 * @param   $rel Array of release data from the API.
	 *  Will also contain `assets` key which is an array of assets.
	 *  @return  bool Whether the page is saved or not.
	 *
	 */
	private function processRelease($rel) {

		$templateName = self::TEMPLATE_NAME;
		$parentPage = $this->pages->get(self::PARENT_SELECTOR);
		$relName = $this->sanitizer->pageName($rel['name']);

		// Find matching page
		$page = $this->pages->get("template={$templateName}, name={$relName}");

		// Doesn't exist - create new one
		if ( ! $page || ! $page->id) {
			$page = new Page();
			$page->template = $templateName;
			$page->parent = $parentPage;
			$page->name = $relName;
			$page->title = $rel['name'];
			$page->save();
		}

		// Update attrs

		$page->title = $rel['name'];
		$page->body = $this->parseBody($rel['body']);

		if (empty($rel['assets'])) {
			// Empty assets - just use zipball
			$page->link_url = $rel['zipball_url'];
			$page->size_bytes = 0;
		} else {
			$asset = $rel['assets'][0];
			$page->link_url = $asset['browser_download_url'];
			$page->size_bytes = $asset['size'];
		}

		$page->date = $this->datetime->stringToTimestamp($rel['created_at'], 'Y-m-d\TH:i:s\Z');

		return $page->save();
	}


	/**
	 * Get latest release and point downloads page to it
	 *
	 */
	private function updateLatest() {

		$templateName = self::TEMPLATE_NAME;
		$parentPage = $this->pages->get(self::PARENT_SELECTOR);

		$latestPage = $parentPage->find("template={$templateName}, sort=-date, limit=1")->first();

		if ($latestPage && $latestPage->id) {
			return $parentPage->setAndSave('current_release', $latestPage);
		}

		return null;
	}


	/**
	 * Get the assets for a given release from the GitHub API.
	 * Returns an empty array by default, but if success, array of assets from API.
	 *
	 * @param   $url URL for assets of a given release.
	 * @return  array
	 *
	 */
	private function getAssets($url) {
		$http = new WireHttp();
		$response = $http->getJSON($url);
		if ($response !== false) {
			return $response;
		}
		return [];
	}


	/**
	 * Use the Textformatter Markdown module to parse the notes from the release at GitHub
	 *
	 * @param  string $source 	Markdown text from GitHub release
	 * @return  string HTML of processed Markdown
	 *
	 */
	private function parseBody($source = '') {
		$mdextra = $this->modules->get('TextformatterMarkdownExtra');
		return $mdextra->markdown($source, TextformatterMarkdownExtra::flavorDefault);
	}


}
