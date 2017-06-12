<?php
/**
 * Created by PhpStorm.
 * User: fengchang
 * Date: 2017/6/9
 * Time: 下午10:08
 */

require 'config.php';
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

date_default_timezone_set('Asia/Hong_Kong');

$log = new Logger('readhub-rss');
$log->pushHandler(new RotatingFileHandler(LOG_PATH, LOG_KEEP_DAYS, Logger::INFO));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Readhub RSS</title>
</head>
<body>
<div style="width: 600px; margin: 100px auto 0px">
    <p>这是一个通过 RSS 订阅 Readhub 的站点，您可以自己选择想要订阅的频道。</p>

    <p>
        全部频道:  <a href="<?=RSS_URL?>?channel=all"><?=RSS_URL?>?channel=all</a>
        <img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-rss-s.png" alt="">
    </p>

    <fieldset>
        <legend>自定义频道</legend>
        <?php
        foreach (CHANNEL_CONFIG as $channel=>$attributes) {
            echo "<div>";
            echo "<input type='checkbox' id='$channel' name='channel' value='$channel' onchange='generateRss()'>";
            echo "<label for='$channel'>{$attributes['name']}</label>";
            echo "</div>";
        }
        ?>
        <p>
            <a id="customRssLink" href="">请选中需要订阅的频道</a>
            <img id="customRssIcon" src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-rss-s.png" alt="">
        </p>
    </fieldset>
</div>
<script>
    function generateRss() {
        var checkboxes = document.getElementsByName('channel');
        var checkedValue = [];
        for (var i=0; i<checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                checkedValue.push(checkboxes[i].value);
            }
        }
        if (checkedValue.length > 0) {
            var rssBaseUrl = "<?=RSS_URL?>";
            var rssUrl = rssBaseUrl + '?channel=' + checkedValue.join(",");
            document.getElementById('customRssLink').innerHTML = rssUrl;
            document.getElementById('customRssLink').href = rssUrl;
            document.getElementById('customRssIcon').style.display = "inline";
        } else {
            document.getElementById('customRssLink').innerHTML = "请选中需要订阅的频道";
            document.getElementById('customRssLink').removeAttribute('href');
            document.getElementById('customRssIcon').style.display = "none";
        }
    }
    generateRss();
</script>
</body>
</html>