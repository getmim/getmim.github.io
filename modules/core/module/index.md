---
layout: post
title:  "Module"
date:   2015-01-11 07:44:45 +0700
categories: module
---

Module pada framework mim adalah bagian inti dari framework itu sendiri. Aplikasi
adalah gabungan dari module-module yang saling bekerja sama sehingga menghasilkan
suatu sistem yang sesuai dengan yang diharapkan developer.

Bagian inti dari framework ini adalah sebuah module dengan nama core. Module corelah
yang bertugas memenej semua module-module yang lain sehingga bisa bekerja dengan
yang diharapkan.

Bagian inti sebuah module harus disimpan di folder `./modules/[name]`. Sementara
file-file lainnya bebas disimpan di mana saja di folder aplikasi selama keberadaan
file tersebut didaftarkan di konfigurasi module.