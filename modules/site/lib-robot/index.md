---
layout: post
title:  "Robot"
date:   2016-02-08 01:01:01 +0700
categories: ext-module
---

Module untuk menggenerasi RSS Feed, dan sitemap dari data object.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-robot
```

## Penggunaan

Module ini menambahkan dua library yaitu `LibRobot\Library\Sitemap` untuk menggenerasi
sitemap, dan `LibRobot\Library\Feed` untuk menggenerasi rss feed.

```php
use LibRobot\Library\Sitemap;
use LibRobot\Library\Feed;

// ... di dalam controller.action
    $data = [
        (object)[
            'description'   => '...',           // required. feed
            'page'          => '...',           // required. feed|sitemap
            'published'     => 'Y-m-d H:i:s',   // required. feed
            'updated'       => 'Y-m-d H:i:s',   // required. feed|sitemap
            'priority'      => '...',           // required. sitemap
            'title'         => '...',           // required. feed
            'changefreq'    => '...',           // required. sitemap
            'guid'          => '...',           // required. feed

            'author'        => '...',           // optional. feed
            'categories'    => ['...','...'],   // optional. feed
            'comment'       => '...',           // optional. feed
            'image'         => [                // optional. feed
                'url'           => '...',           // required. feed
                'caption'       => '...',           // optional. feed
                'title'         => '...',           // optional. feed
                'license'       => '...',           // optional. feed
            ]
        ]
    ];

    $feed_opts = (object)[
        'self_url'          => \Mim::$app->router->to('selfFeed'),
        'copyright_year'    => date('Y'),
        'copyright_name'    => \Mim::$app->config->name,
        'description'       => 'Site description or meta description',
        'language'          => 'id-id',
        'host'              => \Mim::$app->router->to('siteHome'),
        'title'             => 'Some RSS Feed title',
    ];

    Sitemap::render($data);
    // Feed::render($data, $feed_opts);
    $this->res->setCache(1000);
    $this->res->send();
// ...
```