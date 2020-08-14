---
layout: post
title:  "Service Config"
date:   2015-01-06 08:44:45 +0700
categories: aplikasi service
---

Service Config adalah service yang menyediakan *getter* untuk konfigurasi
aplikasi. Nilai konfigurasi aplikasi yang diberikan oleh service ini adalah
penggabungan semua konfigurasi module dengan fungsi php `array_replace_recursive`,
dan kemudian menggabungkan konfigurasi aplikasi ke hasil penggabungan tersebut
dengan fungsi php yang sama.

Service ini bisa diakses dari kontroler, service, dan middleware dengan syntax
`$this->config->$prop`. Semua array konfigurasi diubah menjadi objek secara
recursive. Yang artinya, konfigurasi module yang awalnya adalah array harus diakses
dengan bentuk objek. Jadi, untuk mengakses sub-array dari suatu konfigurasi, 
bisa menggunakan syntax `$this->config->$prop->$subprop->$subsubprop`. Walaupun
demikian, nilai indexed array pada konfigurasi akan tetap menjadi array.

Sifat konfigurasi yang dilayani oleh service ini adalah *readonly*. Tidak ada cara
untuk mengubah nilai konfigurasi kecuali dari file konfigurasi masing-masing
module atau konfigurasi aplikasi, dan menjalankan `mim app config` untuk menggenerasi
ulang konfigurasi aplikasi.