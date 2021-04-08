---
layout: post
title:  "Site Meta"
date:   2016-02-04 01:01:01 +0700
categories: ext-module site
---

Adalah module yang bertugas menggenerasi html meta tags. Pada umumnya, module ini
digunakan pada view untuk menggenerasi bagian-bagian umum pada html seperti meta data,
google analytics, alexa script, dan lain-lain.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install site-meta
```

## Konfigurasi

Tambahkan konfigurasi seperti di bawah pada konfigurasi aplikasi. Sebagai catatan,
jika module `site-setting` terpasang, maka nilai-nilai konfig seperti di bawah akan
ditindih dari nilai site setting dengan nama yang sama dengan prefix `meta.` jika ada.

Sebagai contoh nilai site setting `meta.fb_js` akan menindih nilai konfigurasi `fb_js`
di bawah.

```php
return [
    'siteMeta' => [
        'params' => [
            // alexa analytics account
            'al_an_account' => '',

            // alexa analytics domain
            'al_an_domain' => '',

            // alexa site verification
            'al_verification' => '',

            // bing site verification
            'bi_verification' => '',

            // site theme color
            'color' => '#CCCCCC',

            // include facebook js
            'fb_js' => true,

            // facebook app id
            'fb_appid' => 'fb-app-id',

            // facebook page id
            'fb_pageid' => '9012310239123',

            // include google js
            'go_js' => true,

            // google site verification
            'go_verification' => '',

            // google analytics property
            'ga_property' => '',

            // google tag analytics
            'gtag_property' => '',

            // include instagram js
            'ig_js' => true,

            // site locale
            'locale' => 'id-ID',

            // site name. digunakan di akhir
            // setelah page title.
            'name' => 'Website',

            // pinterest site verification
            'pi_verification' => '',

            // is the theme responsive
            'viewport' => 'responsive',

            // include twitter js
            'tw_js' => true,

            // yandex site verification
            'ya_verificationn' => ''
        ]
    ]
];
```

## Penggunaan

Jalankan perintah seperti di bawah pada head elemen html:

```php
<head>
    <?=
        $this->meta->head([

            // AMPHtml URL, optional
            'amphtml' => 'URL',

            // additional csses files, optional
            'csses' => [
                'css-file-1',
                'css-file-2'
            ],

            // Page description, recommended
            'description' => '...',

            // Page image, recommended
            'image' => '...',

            // identitas jika halaman yang sedang
            // digenerasi adalah halaman amphtml
            'is_amp' => false,

            // Content published time, optional
            'published_time' => '...',

            // RSS Feed URL, optional
            'rss' => 'URL',

            // List of schema.org in array format. recommended
            'schema.org' => [
                [...],
                [...]
            ],

            // Page type, used for `og:type`. optional
            'type' => '',

            // Page title, required
            'title' => '...',

            // Updated time, recommended
            'updated_time' => '...'

            // URL ( canonical ), required
            'url' => 'URL',

            // list of hreflangs
            'locales' => [
                'en-US' => 'URL',
                'id-ID' => 'URL'
            ],

            // additional meta tag
            'metas' => [
                'prop' => 'value'
            ]
        ]);
    ?>
</head>
```

Dan pada bagian footer sebelum closing tag body, tambahkan perintah seperti di bawah:

```php
<body>
    <!-- ... -->
    <?=
        $this->meta->foot([
            // add jquery
            'jquery' => '3.3.1|true',

            // additional js to append
            'jses' => [
                'url-to-js-1',
                'url-to-js-2'
            ]
        ]);
    ?>
</body>
```

Perlu diketahui bahwa **TIDAK BOLEH** menggunakan fungsi ini pada halaman AMPHtml.

Jika properti `jquery` di set, maka jquery akan ditambahkan pada footer. Nilai dari properti ini
diharapkan versi jquery yang akan digunakan, jika diset sebagai true, maka nilai `3.3.1` akan
digunakan.

Sebagai catatan, module ini mengharapkan file-file logo ada dan tersimpan di folder sebagai berikut:

```
theme/site/static/logo/48x48.png
theme/site/static/logo/100x100.png
theme/site/static/logo/72x72.png
theme/site/static/logo/114x114.png
theme/site/static/logo/192x192.png
theme/site/static/logo/200x60.png
```
