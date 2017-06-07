<?php
/**
 * Created by PhpStorm.
 * User: fengchang
 * Date: 2017/6/7
 * Time: 下午10:49
 */
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use \FeedWriter\ATOM;

date_default_timezone_set('Asia/Hong_Kong');

$log = new Logger('readhub-rss');
$log->pushHandler(new StreamHandler('php://stdout', Logger::DEBUG));

$readhub_data = json_decode(file_get_contents('https://api.readhub.me/topic?pageSize=10'), True);

$feed = init_feed();
foreach ($readhub_data['data'] as $readhub_item) {
    $feed_item = $feed->createNewItem();
    fill_feed_item($feed_item, $readhub_item);
    $feed->addItem($feed_item);
}
$feed->printFeed();

/**
 * @return ATOM
 */
function init_feed(){
    $feed = new ATOM();
    $feed->setTitle('Readbub');
    $feed->setDescription('A RSS feed for Readhub');
    $feed->setLink('https://readhub.me/');
    $feed->setDate(new DateTime());
    $feed->setImage('https://cdn.readhub.me/static/assets/png/readhub_logo.png');
    $feed->setChannelElement('author', array('name'=>'fengchang'));
    $feed->setSelfLink('http://readhub.bayes.cafe/rss.php');

    return $feed;
}

/**
 * @param $feed_item \FeedWriter\Item
 * @param $rh_item array
 * @return \FeedWriter\Item
 */
function fill_feed_item($feed_item, $rh_item) {
    $feed_item->setTitle($rh_item['title']);
    $feed_item->setDate($rh_item['publishDate']);

    $news = $rh_item['newsArray'][0];
    $feed_item->setLink($news['url']);
    $feed_item->setAuthor($news['iteName'].' / '.$news['authorName']);
    $feed_item->setId('urn:readhub:'.$rh_item['id']);

    $content = "<p>{$rh_item['summary']}</p>";
    foreach ($rh_item['newsArray'] as $rh_news) {
        $content = $content."<p><a href='{$rh_news['url']}'>{$rh_news['siteName']} : {$rh_news['title']}</a></p>";
    }
    $feed_item->setDescription($content);
    return $feed_item;
}