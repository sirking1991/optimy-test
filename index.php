<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Utilities\CommentManager;
use App\Utilities\NewsManager;

$newsManager = NewsManager::getInstance();
$commentManager = CommentManager::getInstance();

foreach ($newsManager->listNews() as $news) {
	echo( 
		str_repeat('#', 12) . 
		' NEWS ' . 
		$news->getTitle() . 
		' ' . 
		str_repeat('#', 12) . 
		"\n"
	);

	echo($news->getBody() . "\n");

	foreach ($commentManager->listComments() as $comment) {
		if ($comment->getNewsId() == $news->getId()) {
			echo("Comment " . $comment->getId() . " : " . $comment->getBody() . "\n");
		}
	}
}

$c = $commentManager->listComments();