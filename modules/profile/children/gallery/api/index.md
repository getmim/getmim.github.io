---
layout: post
title:  "Api Profile Gallery"
date:   2016-01-14 01:01:02 +0700
categories: profile profile-gallery api
---

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install api-profile-gallery
```

## Endpoints

### POST {APIHOST}/profile/read/(profile.id)/gallery{title,images}

### GET {APIHOST}/profile/read/(profile.id)/gallery?{q,rpp=12,page=1}

### DELETE {APIHOST}/profile/read/(profile.id)/gallery/(gallery.id)

### GET {APIHOST}/profile/read/(profile.id)/gallery/(gallery.id)

### PUT {APIHOST}/profile/read/(profile.id)/gallery/(gallery.id){title,images}