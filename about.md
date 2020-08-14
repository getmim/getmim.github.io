---
layout: page
title: About
permalink: /about/
---

Mim adalah framework yang ditulis dengan mengedepankan kecepatan dan keamanan
tentunya. Aplikasi yang dibuat menggunakan framework ini terbentuk dari
module-module dasar yang mengisi fungsi-fungsi aplikasi. Yang artinya semua
bagian pada aplikasi pada dasarnya adalah module. Aplikasi berdasarkan framework
mim dibuat dari beberapa module yang saling bekerja sama, mulai dari handler
router, bahkan sampai core framework mim itu sendiri.

Masing-masing konfigurasi module digabungkan dengan perintah `array_replace_recursive`
dan kemudian digabungkan lagi dengan konfigurasi aplikasi dengan fungsi yang sama.
Penggabungan seperti ini memungkinkan developer aplikasi menindih konfigurasi
module dengan mudah, tanpa harus mengubah file milik module.

Konfigurasi module adalah file yang ada di `./modules/[module_name]/config.php`,
sementara konfigurasi aplikasi adalah file yang ada di `./etc/config/[main|development|production].php`.

Pada saat aplikasi disimpan di repository, konten yang disimpan hanya file khusus
milik aplikasi saja. File-file milik module tidak ikut disimpan di repository
aplikasi. Ketika aplikasi siap di deploy, perintah `mim app install` akan mengambil
konten module dari repository nya masing-masing untuk dipasangkan ke aplikasi
berdasarkan informasi yang ada di `./etc/modules.php`.