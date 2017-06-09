<?php
/**
 * Created by PhpStorm.
 * User: fengchang
 * Date: 2017/6/10
 * Time: 上午12:31
 */

require 'vendor/autoload.php';

use FeedWriter\ATOM;

date_default_timezone_set('Asia/Hong_Kong');


$feed = initFeed();

$item = $feed->createNewItem();

$item->setTitle('This url is stopped using for subscribe. 这个 url 已经停止使用');
$item->setDate('2017-06-10T00:38:36+08:00');
$item->setLink('http://readhub.bayes.cafe/index.php');
$item->setAuthor('fengchang');
$item->setId('urn:readhub:'.'stopped_service');
$item->setDescription("这个 url 已经停止使用，请到 <a href='http://readhub.bayes.cafe/index.php'>http://readhub.bayes.cafe/index.php</a> 重新选择需要订阅的频道。谢谢.");

$feed->addItem($item);
$feed->printFeed();

/**
 * @return ATOM
 */
function initFeed()
{
    $feed = new ATOM();
    $feed->setTitle('Readbub');
    $feed->setDescription('A RSS feed for Readhub');
    $feed->setLink('https://readhub.me/');
    $feed->setDate(new DateTime());
    $feed->setImage('https://cdn.readhub.me/static/assets/png/readhub_logo.png');
    $feed->setChannelElement('author', 'fengchang@bayescafe.com');
    $feed->setSelfLink(RSS_URL);

    return $feed;
}

