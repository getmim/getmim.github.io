---
layout: post
title:  "Site Static Page"
date:   2017-01-01 01:01:01 +0700
categories: ext-module
---

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install site-static-page
```

## Event Listener

1. `static-page:created` `(object $page)` - TODO
1. `static-page:deleted` `(object $page)`
1. `static-page:updated` `(object $page)`

## EndPoints

### `GET /page/(:slug)`

### `GET /page/feed.xml`