# blog.returnnull.de

This is the source code behind [blog.returnnull.de](https://blog.returnnull.de).

#### Tech Stack
[![php](code/public/img/stack/php.png)](https://www.php.net/manual/de/intro-whatis.php)
[![PHPUnit](code/public/img/stack/phpunit.png)](https://phpunit.de/)
[![Composer](code/public/img/stack/composer.png)](https://getcomposer.org/)
[![MySQL](code/public/img/stack/mysql.png)](https://dev.mysql.com/doc/refman/8.0/en/what-is-mysql.html)
[![HTML](code/public/img/stack/html.png)](https://developer.mozilla.org/de/docs/Learn/Getting_started_with_the_web/HTML_basics)
[![SASS](code/public/img/stack/sass.png)](https://sass-lang.com/)
[![Docker](code/public/img/stack/docker.png)](https://docs.docker.com/get-started/overview/)
[![Docker-Compose](code/public/img/stack/docker-compose.png)](https://docs.docker.com/compose/)
[![Nginx](code/public/img/stack/nginx.png)](https://www.nginx.com/)
[![PHPStorm](code/public/img/stack/phpstorm.png)](https://www.jetbrains.com/de-de/phpstorm/)
[![Git](code/public/img/stack/git.png)](https://git-scm.com/)


#### How to Start Development
* clone repository
* build images with `make build_dev`
* use `make run` to start the containers
    * `make install` to install the dependencies and to update the autoloader (do this everyime you add a new class)
* use `make stop` to stop the containers

### Access Admin Panel
* go to http://localhost/admin
* login with username `tolik518` and password `tolik518`

#### How to execute PHPUnit-Tests
* `make unit_test`
* if you want to see the coverage in PHPStorm then follow these steps:
    * Go to the menu bar in PHPStorm at the top
    * Go to `Run` -> `Show Coverage Data` or press `Strg + Alt + 6` -> `+`
    * then choose `(projectfolder)/code/tests/reports/phpunit.coverage.xml` and press `OK` and `show selected`



<!--
    TODO: Tag-System im Admin Bereich
    TODO: Klickbare Tags -> Tag-Page/Projector
    TODO: Artikelvorschläge auf Grund von Tags

    TODO: Head Modulieren

    TODO: Analytics PLUS
    TODO: Anti-Spam gegen Spammer

    TODO: https://developers.google.com/search/docs/advanced/structured-data/article

    TODO: <link rel="alternate" type="application/rss+xml" title="RSS" href="http://blog.returnnull.de/feed.rss" />
    TODO: Sitemap
    TODO: security.txt
    TODO: _badwords.txt
    TODO: https://en.wikipedia.org/wiki/Well-known_URI lesen und umsetzten
    TODO: meta data & SEO
    TODO: Add (google) search appearance
    TODO: apple-touch-icon.png https://www.elmastudio.de/ein-apple-touch-icon-fur-die-eigene-webseite-erstellen/
                             - https://webhint.io/docs/user-guide/hints/hint-apple-touch-icons/
    TODO: Social media formatting/Link preview (FB, Twitter, Telegram)
          - https://developers.facebook.com/docs/sharing/webmasters#markup
          - https://developer.twitter.com/docs/twitter-for-websites/cards/overview/markup
-->