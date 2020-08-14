---
layout: post
title:  "Site Gallery"
date:   2016-01-22 01:01:01 +0700
categories: gallery
---

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install site-gallery
```

## Event Listener

1. `gallery:created` `(object $gallery)`
1. `gallery:deleted` `(object $gallery)`
1. `gallery:updated` `(object $gallery)`

## EndPoints

### `GET /gallery/(:slug)`

### `GET /gallery/feed.xml`