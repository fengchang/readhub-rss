<?php
/**
 * Created by PhpStorm.
 * User: fengchang
 * Date: 2017/6/9
 * Time: 下午8:40
 */

define("ENABLE_CACHE", FALSE);

define("REDIS_HOST", "127.0.0.1");
define("REDIS_PORT", 6379);
define("CACHE_EXPIRE", 300);

define("LOG_PATH", '/opt/logs/bayes/readhub-rss/info.log');
define("LOG_KEEP_DAYS", 10);

define("RSS_URL", 'http://readhub.bayes.cafe/rss');
define("READHUB_DOMAIN", 'https://api.readhub.cn');

const CHANNEL_CONFIG = [
    'topics' => ["name" => "热门话题", "className" => "Api\Topics"],
    'news' => ["name" => "科技动态", "className" => "Api\News"],
    'technews' => ["name" => "开发者资讯", "className" => "Api\TechNews"]
];