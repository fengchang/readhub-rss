<?php
/**
 * Created by PhpStorm.
 * User: fengchang
 * Date: 2017/6/9
 * Time: 下午9:08
 */

namespace Api;


class News extends BaseApi
{
    function getData()
    {
        $readhubData = json_decode($this->httpGet('https://api.readhub.me/news?pageSize=20'), True);
        $items = [];

        foreach ($readhubData['data'] as $readhubItem) {

            $author = $readhubItem['siteName'].' / '.$readhubItem['authorName'];

            $feedItem = $this->generateItem($readhubItem['title'], $readhubItem['publishDate'],
                $readhubItem['url'], $author, 'news:'.$readhubItem['id'], $readhubItem['summary']);

            $items[] = $feedItem;
        }

        return $items;
    }
}