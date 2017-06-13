# Readhub-RSS

这是一个通过 RSS 订阅 Readhub 的服务，包括了「热门话题」、「科技动态」、「开发者资讯」三个频道。该服务会在被访问时调用 Readhub 接口并将数据转换为 `ATOM` 格式。

要使用这套服务，您需要先安装好 `composer`，之后下载代码并运行 `install.sh` 安装依赖。

服务可以访问后，您还需要修改 `config.php` 中的 `RSS_URL` 配置，以使 `index.php` 生成的订阅地址指向您自己的服务。

如果您不想自己搭建服务，可以通过 [http://readhub.bayes.cafe/](http://readhub.bayes.cafe/) 订阅。