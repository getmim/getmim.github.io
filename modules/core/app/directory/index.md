---
layout: post
title:  "Struktur Folder"
date:   2015-01-02 07:44:45 +0700
categories: aplikasi
---

Secara umum, di bawah ini adalah bagaimana bentuk struktur folder aplikasi berbasis
framework mim.

```
./
    index.php
    app/
        [module_name]/
            controller/
    etc/
        .env
        modules.php
        config/
            main.php
            [env].php
        cache/
        cert/
        log/
    modules/
        [name]/
            config.php
            controller/
            helper/
            library/
            model/
            service/
```

## Keterangan

### ./index.php

Tujuan utama file ini ada hanya untuk melanjutkan request ke module core untuk
di proses ke middleware dan router handler selanjutnya.

### ./app/

Pada folder ini disimpan file-file module yang akan diakuisisi oleh aplikasi, semua
konten di folder ini tetap dimasukan ke dalam repository aplikasi. Module sebaiknya
hanya boleh menambah file ke dalam folder ini tapi tidak diperbolehkan mengubah
file yang sudah ada.

Tujuan utama folder ini ada adalah memberi kebebasan kepada developer aplikasi
untuk menentukan bagaimana sebaiknya suatu module bekerja tanpa merusak source
code module.

Subfolder dari folder ini harus menggunakan nama module yang membuatnya.

### ./etc/

Folder ini berisi data lain-lain yang secara tidak langsung berhubungan dengan
module, dan secara langsung berhubungan dengan aplikasi.

### ./etc/.env

File `.env` berisi satu baris teks yang adalah salah satu dari `development`,
`production`, atau `test`. Nilai ini digunakan untuk menentukan default environment
aplikasi. Nilai `production` tidak akan menampilkan pesan error ke user. 

Pastikan menjalankan perintah `mim app config` setiap melakukan perubahan pada 
file ini.

### ./etc/modules.php

File ini berisi semua module yang terinstal dan alamat repository nya. Fungsi utama
file ini ada adalah sebagai referensi perintah `mim app install` untuk menentukan
module apa saja yang akan diinstall. File ini terbuat otomatis oleh cli, dan 
sebaiknya jangan meng-edit menual konten di dalam nya.

### ./etc/config/

Folder ini menyimpan semua konfigurasi aplikasi.

### ./etc/config/main.php

File ini berisi konfigurasi aplikasi, nilai di dalamnya adalah konten yang paling
terakhir yang akan digabungkan dengan konfigurasi module-module yang lain. Jika
ada nama konfig yang sama dengan yang ada pada module, maka nila pada file ini yang
akan digunakan. Silahkan mengacup ada 
[konfigurasi aplikasi](/modules/core/app/configuration/) untuk
informasi lebih details.

### ./etc/config/[env].php

Jika suatu konfigurasi tertentu perlu ditambahkan pada konfigurasi aplikasi ( `main.php` )
yang mana nilainya bergantung pada nilai environment, maka membuat file dengan 
nama enviroment adalah solusi yang paling tepat. File dengan nama sesuai dengan
nilai env akan digabungkan dengan konfigurasi aplikasi setelah file `main.php`
ditambahkan.

### ./etc/cache/

Adalah folder di mana semua cache file disimpan.

### ./etc/cert/

Folder di mana certificate ssl disimpan.

### ./etc/log/

Semua log disimpan, termasuk error log dan access log ( jika digunakan ).

### ./modules/

Folder ini berisi module-module aplikasi, isi dari folder ini tidak diikutkan pada
repository aplikasi. Ketika akan men-deploy aplikasi, pastikan menjalankan perintah
`mim app install` atau `mim app update` untuk meng-install/update semua module
aplikasi. Untuk informasi lebih jelas tentang module, silahkan mengacu pada 
[module](/modules/core/module/).

### ./modules/[name]/

Di sini semua file-file module disimpan, termasuk file konfigurasi module, kontroler,
model, library, dan lain-lain.

### ./modules/[name]/config.php

File ini berisi data-data module, dan akan diikutkan pada saat menggenerasi konfigurasi
aplikasi. Masing-masing konfigurasi module akan digabungkan dengan perintah
`array_replace_recursive` dan pada akhirnya digabungkan dengan konfigurasi
aplikasi. Nilai penggabungan semua konfigurasi tersebut yang akan digunakan oleh
aplikasi. Mengacu pada [konfigurasi module](/modules/core/module/config/)
untuk informasi lebih jelas tentang konfigurasi module.

File ini adalah satu-satunya file yang harus ada dalam satu module.