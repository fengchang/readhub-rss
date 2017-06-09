<?php
/**
 * Created by PhpStorm.
 * User: fengchang
 * Date: 2017/6/9
 * Time: 下午8:46
 */

namespace Api;


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
}