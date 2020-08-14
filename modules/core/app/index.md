---
layout: post
title:  "Aplikasi"
date:   2015-01-01 07:44:45 +0700
categories: aplikasi
---

Istilah aplikasi pada framework mim adalah tempat bergabung dan bekerjasama-nya
satu atau beberapa module. Satu aplikasi biasanya dibuat dengan perintah cli
`mim app init`, perintah ini adalah alternatif untuk perintah `mim app install core`.
Kedua perintah ini bertugas memasang module `core` pada folder di mana perintah
tersebut dijalankan.

Seperti dijelaskan pada bagian [about]({% link about.md %}), suatu aplikasi pada
framework mim pada dasarnya adalah gabungan module-module mim, yang salah satunya
adalah module `core`.

Module `core` adalah satu-satu nya module yang harus ada pada aplikasi berbasis
framework mim. Module inilah yang bertugas memenej semua module yang ada di
aplikasi.

Pada pembahasan tentang aplikasi, sebenarnya kita sedang membahas tentang module
`core`, bagaimana dia bekerja, dan bagaimana dia memenej module agar bisa bekerja
dengan baik.