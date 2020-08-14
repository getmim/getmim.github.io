---
layout: post
title:  "IP DB"
date:   2016-02-06 01:01:02 +0700
categories: lib-ip-locator
---

Adalah salah satu library untuk penyedia data lokasi ip. Module ini harus digunakan sebagai
finder dan keeper dari module [lib-ip-locator](https://github.com/getmim/lib-ip-locator).

Informasi ip yang diambil adalah dari table `ipdb` yang dibuat oleh module ini. Data yang tersimpan
pada tabel tersebut umumnya berasal dari ip locator finder yang lain. Begitu suatu nilai lokasi ip 
ditemukan, informasi tersebut akan tersimpan pada tabel `ipdb` selama kurang lebih 1 minggu. Sehingga
jika ada request untuk mencari informasi ip tersebut dikemudian hari, maka data dari table ini yang
akan digunakan.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-ip-db
```

## Developer Finder

Jika akan mendevelop library finder yang lain, pastikan nilai priority tida lebih dari 100.000.