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
        $readhubData = json_decode($this->httpGet(READHUB_DOMAIN.'/topic?pageSize=20'), True);
        $items = [];

        foreach ($readhubData['data'] as $readhubItem) {
            try {
                $firstNews = $readhubItem['newsArray'][0];
                $author = $firstNews['siteName'].' / '.$firstNews['authorName'];

                $content = "<p>{$readhubItem['summary']}</p>";
                foreach ($readhubItem['newsArray'] as $rh_news) {
                    $content = $content."<p><a href='{$rh_news['url']}'>{$rh_news['siteName']} : {$rh_news['title']}</a></p>";
                }

                $publishDate = $readhubItem['publishDate'];
                if ($publishDate == NULL)
                    $publishDate = $readhubItem['updatedAt'];

                $feedItem = $this->generateItem($readhubItem['title'], $publishDate,
                    $firstNews['url'], $author, 'topic:'.$readhubItem['id'], $content);

                $items[] = $feedItem;
            } catch (\Exception $e) {
                $this->getLogger()->addError($e->getMessage());
                $this->getLogger()->addError($e->getTraceAsString());
            }
        }

        return $items;
    }

}