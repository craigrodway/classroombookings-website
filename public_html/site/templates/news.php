<?php
namespace ProcessWire;

$view = [
	'topicList' => '',
];

$limit = $config->pagination['limit'];
$newsPage = $pagecache->news;


/**
 * If on archive page (they just require() this template file)
 *
 */
if ($page->template->name == 'news-year') {
	$view['posts'] = $page->children("template=news-post, date<=now, sort=-date, sort=-created, limit={$limit}");
	$title = "News articles in {$page->title}";
	region('pageTitle', $title);
}


/**
 * Topic page
 *
 */
if ($page->template->name == 'topic') {

	$view['posts'] = $newsPage->find("template=news-post, date<=now, topics={$page}, sort=-date, sort=-created, limit={$limit}");
	$title = "News articles in {$page->title}";
	region('pageTitle', $title);

	$view['topicList'] = renderNewsTopicList([
		'title' => 'View:',
		'showLatest' => true,
		'latestTitle' => 'Latest',
	]);
}


/**
 * Standard page
 *
 */
if ( ! isset($view['posts'])) {

	$view['posts'] = $page->find("template=news-post, date<=now, sort=-date, sort=-created, limit={$limit}");

	region('pageTitle', 'Latest news');

	$view['topicList'] = renderNewsTopicList([
		'title' => 'View:',
		'showLatest' => true,
		'latestTitle' => 'Latest',
	]);

}

// $view['pageTitle'] = region('pageTitle');

$view['pager'] = $view['posts']->renderPager($config->pagination);

region('content', wireRenderFile('views/news/posts', $view));
