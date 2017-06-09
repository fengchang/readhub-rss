<?php
/**
 * Created by PhpStorm.
 * User: fengchang
 * Date: 2017/6/9
 * Time: 下午8:44
 */

namespace Api;


class Topics extends BaseApi
{
    function getData()
    {
        $readhubData = json_decode(file_get_contents('https://api.readhub.me/topic?pageSize=20'), True);
        $items = [];

        foreach ($readhubData['data'] as $readhubItem) {
            $firstNews = $readhubItem['newsArray'][0];
            $author = $firstNews['siteName'].' / '.$firstNews['authorName'];

            $content = "<p>{$readhubItem['summary']}</p>";
            foreach ($readhubItem['newsArray'] as $rh_news) {
                $content = $content."<p><a href='{$rh_news['url']}'>{$rh_news['siteName']} : {$rh_news['title']}</a></p>";
            }

            $feedItem = $this->generateItem($readhubItem['title'], $readhubItem['publishDate'],
                $firstNews['url'], $author, 'topic:'.$readhubItem['id'], $content);

            $items[] = $feedItem;
        }

        return $items;
    }

}