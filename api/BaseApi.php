<?php
/**
 * Created by PhpStorm.
 * User: fengchang
 * Date: 2017/6/9
 * Time: 下午8:46
 */

namespace Api;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

use FeedWriter\ATOM;

abstract class BaseApi
{
    abstract function getData();

    protected function generateItem($title, $date, $link, $author, $id, $description) {
        $feed = new ATOM();
        $item = $feed->createNewItem();

        $item->setTitle($title);
        $item->setDate($date);
        $item->setLink($link);
        $item->setAuthor($author);
        $item->setId('urn:readhub:'.$id);
        $item->setDescription($description);
        return $item;
    }

    protected function httpGet($url) {
        $log = new Logger('readhub-rss');
        $log->pushHandler(new RotatingFileHandler(LOG_PATH, LOG_KEEP_DAYS, Logger::INFO));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result=curl_exec($ch);

        $info = curl_getinfo($ch);
        $log->addInfo("HTTP Request to {{$info['url']}}. Response code: {$info['http_code']}. Took time {$info['total_time']}.");

        curl_close($ch);
        return $result;
    }
}