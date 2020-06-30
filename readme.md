# Notta 开源文档管理系统

## 概述

Notta 是一款基于 [Wizard](https://github.com/mylxsw/Wizard) 开发的开源文档管理系统，目前支持三种类型的文档管理

- **Markdown**：也是Notta最主要的文档类型，研发团队日常工作中交流所采用的最常用文档类型，在 Notta 中，使用了更加美观的 Vditor 编辑器
- **Swagger**：支持 [OpenAPI 3.0](https://swagger.io/specification/) 规范，集成了 Swagger 官方的编辑器，支持文档模板，全屏编辑，文档自动同步功能
- **Table**：这种文档类型是类似于 Excel 电子表格，集成了 [x-spreadsheet](https://github.com/myliang/x-spreadsheet) 项目

目前主要包含以下功能

- 企业微信登录
- Swagger，Markdown，Table 类型的文档管理
- 文档修改历史管理
- 文档修改差异对比
- 用户权限管理
- 项目分组管理
- LDAP 统一身份认证
- 文档搜索，标签搜索
- 阅读模式
- 文档评论
- 消息通知
- 单文档分享，文档项目级分享
- 统计功能
- 流程图，序列图，饼图，Tex LaTex 科学公式支持

如果想快速体验一下Notta的功能，请使用以下方式

- 在线体验请访问 [http://notta.nanodeer.com/](http://notta.nanodeer.com/) ，目前只提供部分功能的体验。

## 起源

团队在撰写文档过程中，有时候需要将文档分享给外部用户。此时可以选择的方案就是导出成 PDF 再发给对方。所以我构思了一个使用企业微信登录，并可以把文档分享给外部用户的文档系统。
找了一圈发现没有现成的，于是就站在 Wizard 项目的肩膀上开发了 Notta。

## 功能演示

暂无

## 关于代码

项目采用了 Laravel 开发框架开发，框架已经升级至 7.0

## 授权和服务

项目使用 Apache2.0 授权
未来可能会开发一些商业功能。比如搜索图片和文档附件里的文字。

## 安装

### 手动安装

手动安装方式需要先安装配置好PHP环境，建议采用 PHP-FPM/Nginx 的方式来运行，具体配置参考 环境依赖 部分。

#### 环境依赖

以下组件的安装配置这里就不做详细展开，可以自行 百度/Google 安装方法。

- PHP 7.2 + (需要启用以下扩展)
    - OpenSSL PHP Extension
    - PDO PHP Extension
    - Mbstring PHP Extension
    - Tokenizer PHP Extension
    - XML PHP Extension
    - Ctype PHP Extension
    - JSON PHP Extension
    - BCMath PHP Extension
    - LDAP PHP Extension
    - Zlib PHP Extension （PDF 导出功能需要用到）
- composer.phar
- MySQL 5.7 + / MariaDB （需要支持ARCHIVE存储引擎，MariaDB 10.0+ 默认没有启用参考 **FAQ 3**）
- Nginx
- Git

> PHP 运行环境的创建，可以参考这里 https://gist.github.com/mylxsw/4b7bbe81fb7f59714423f3284c867149

#### 下载代码

推荐使用 git 来下载项目代码到服务器，我们假定将该项目放在服务器的 `/data/webroot` 目录

    cd /data/webroot
    git clone https://github.com/amoydavid/notta.git
    cd Notta

下载代码之后，使用 **composer** 安装项目依赖

    composer install --prefer-dist --ignore-platform-reqs

composer 会在在项目目录中创建 **vendor** 目录，其中包含了项目所依赖的所有第三方代码库。


#### 配置

复制一份配置文件 

    cp .env.example .env

修改 `.env` 中的配置信息，比如 MySQL 连接信息，文件存储目录，项目网址等。

接下来创建数据库，提前在MySQL中创建好项目的数据库，然后在项目目录执行下面的命令

    php artisan migrate:install
    php artisan migrate

接下来配置文件上传目录

    php artisan storage:link

执行该命令后会在 public 目录下创建 `storage/app/public` 目录的符号链接。

在Nginx中配置项目的访问地址

    server {
        listen       80;
        server_name  notta.example.com;
        root         /data/webroot/notta/public;
        index        index.php;
    
        location / {
            index index.php index.html index.htm;
            try_files $uri $uri/ /index.php?$query_string;
        }
        
        location ~ .*\.(gif|jpg|png|bmp|swf|js|css)$ {
            try_files $uri  =302;
        }
        
        location ~ .*\.php$ {
            # php-fpm 监听地址，这里用了socket方式
            fastcgi_pass  unix:/usr/local/php/var/run/php-cgi.sock;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_index index.php;
            include fastcgi_params;
        }
    }

#### 升级

项目升级过程非常简单，只需要使用git拉取最新代码（git pull），然后执行下面的命令完成数据库迁移和依赖更新就OK了。

    composer install --prefer-dist --ignore-platform-reqs
    php artisan migrate


### 初始化

安装完成后，Notta项目就可以通过浏览器访问了，接下来需要访问注册页面创建初始用户 

    http://项目地址/register

在系统中注册的第一个用户为默认管理员角色。

## FAQ

1. 如果在执行数据库迁移（`php artisan migrate`）的时候，报错 `SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes`

    该错误是因为 MySQL 版本低于 5.7，在低版本的 MySQL 中会出现该问题。解决方案如下，二选一即可

    - 在 `.env` 文件中添加配置项 `DB_CHARSET=utf8` 和 `DB_COLLATION=utf8_unicode_ci`，添加之后再执行 `php artisan migrate` 命令（缺点是这样就不支持Emoji了）
    - 升级MySQL到 5.7

2. 报错 `SQLSTATE[HY000] [2054] The server requested authentication method unknown to the client` 和 `The server requested authentication method unknown to the client [caching_sha2_password]`

    因为Mariadb版本比较新，对应的MySQL版本在8.0之后也可能会有问题（默认认证方式修改为了`caching_sha2_password`），解决办法连接到数据库，修改一下密码的认证方式为 `mysql_native_password`：

        ALTER USER 'USERNAME'@'HOSTNAME' IDENTIFIED WITH mysql_native_password BY 'PASSWORD';

    > 参考 [Caching SHA-2 Pluggable Authentication](https://dev.mysql.com/doc/refman/8.0/en/caching-sha2-pluggable-authentication.html)

3. 数据库使用 Mariadb 10.0+ 版本时，执行数据库迁移报错 `Unknown storage engine 'ARCHIVE'` 

    操作日志存储用到了 **ARCHIVE** 存储引擎，Mariadb 10.0 版本之后默认是没有安装这个存储引擎的

    > The ARCHIVE storage engine was installed by default until MariaDB 10.0. In MariaDB 10.1 and later, the storage engine's plugin will have to be installed.

    所以解决方案有下面这两种（**推荐第一种**）

    1. 最简单的方式时在Mariadb中安装这个插件，只需要连接到Mariadb之后执行 `INSTALL SONAME 'ha_archive';` 命令就可以了，**不需要** 重启数据库

    2. 第二种办法时不安装 **ARCHIVE** 存储引擎，修改 `$Notta_HOME/database/migrations/2017_08_03_232417_create_operation_logs_table.php` 文件的第 17 行，将`$table->engine = 'ARCHIVE';` 注释掉（完成迁移之后记得改回去，避免以后使用 `git pull` 来升级系统产生冲突）
        
        ```diff
         Schema::create('wz_operation_logs', function (Blueprint $table) {
        -$table->engine = 'ARCHIVE';
        +// $table->engine = 'ARCHIVE';
         
         $table->increments('id');
        ```

4. 默认上传文件大小限制为 2M，这个限制并不是 Notta 自身的限制，而是运行环境的限制，如何提高上传文件大小限制呢？

   首先需要修改 PHP 的配置文件 `php.ini`，修改以下两行
   
       ; 上传文件大小限制
       upload_max_filesize = 100M
       ; 表单提交大小限制，必须大于 upload_max_filesize，或者可以设置为 0，不做任何限制
       post_max_size = 0
   
   然后，根据 web 服务器的不同进行修改
   
   - **nginx**： 在 nginx 配置中添加 `client_max_body_size 120M;` 来指定最大 body 大小，可以参考 `docker-compose/nginx.conf` 的配置
   - **apache**：修改 Notta 目录 `public/.htaccess` 文件中 `LimitRequestBody 0` 选项的值即可，默认为0表示不限制（默认已经修改过）

5. 导出 Markdown 文档后，图片地址错误，无法显示图片

   需要配置 `APP_URL` 环境变量参数，在 `.env` 文件中，修改 `APP_URL` 地址为当前访问 URL 地址即可。

6. 服务启动后，访问页面报错 500，没有具体错误信息，无法顺利排查问题

   最简单的办法是可以通过查看错误日志来排查问题，日志文件在 `storage/logs/` 目录。如果不够直观，可以在 `.env` 配置文件中修改 `APP_DEBUG=true` 来启用调试模式，在访问页面就会展示具体报错信息了。在 Docker 环境中，可以在启动命令中添加 `-e APP_DEBUG=true` 来启用 DEBUG 模式。

## 关于

如果你觉得这个工具能解决你的实际问题，可以赞赏我一下。

<img width="300px" src="https://static01.imgkr.com/temp/bd3aed01e31a4965ae09247bec2cd0e5.png">

## Stargazers over time

[![Stargazers over time](https://starchart.cc/amoydavid/notta.svg)](https://starchart.cc/amoydavid/notta)
