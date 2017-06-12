<?php
/**
 * Created by PhpStorm.
 * User: fengchang
 * Date: 2017/6/9
 * Time: 下午9:15
 */

namespace Api;


class TechNews extends BaseApi
{
    function getData()
    {
        $readhubData = json_decode($this->httpGet('https://api.readhub.me/technews?pageSize=20'), True);
        $items = [];

        foreach ($readhubData['data'] as $readhubItem) {
            try {
                $author = $readhubItem['siteName'].' / '.$readhubItem['authorName'];

                $feedItem = $this->generateItem($readhubItem['title'], $readhubItem['publishDate'],
                    $readhubItem['url'], $author, 'technews:'.$readhubItem['id'], $readhubItem['summary']);

                $items[] = $feedItem;
            } catch (\Exception $e) {
                $this->getLogger()->addError($e->getMessage());
                $this->getLogger()->addError($e->getTraceAsString());
            }
        }

        return $items;
    }
}