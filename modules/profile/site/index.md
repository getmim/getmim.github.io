---
layout: post
title:  "Site Profile"
date:   2016-01-14 01:01:02 +0700
categories: profile
---

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install site-profile
```

## Event Listener

1. `profile:created` `(object $page)`
1. `profile:deleted` `(object $page)`
1. `profile:updated` `(object $page)`

## EndPoints

### `GET /profile/(:name)`

### `GET /profile/feed.xml`