---
layout: post
title:  "Library Fs"
date:   2015-01-10 08:44:45 +0700
categories: aplikasi library
---

Library ini adalah library bawaan module core yang menyediakan method-method yang
berhubungan dengan filesystem. Nama lengkap library ini adalah `Mim\Library\Fs`
dan bisa digunakan di mana saja di aplikasi.

## method

Method yang disediakan adalah:

### cleanUp(string $path): bool

Fungsi untuk membersikan suatu path sampai ke atas. Fungsi ini menghapus semua folder
sampai ke paling atas jika folder tersebut tidak berisi file/folder.

### copy(string $source, string $target)

Menyalin file dari satu tempat ke tempat lain.

### mkdir(string $path): bool

Fungsi untuk membuat folder secara recursive. Fungsi ini akan mengembalikan nilai 
`true` jika proses pembuatan folder berhasil, dan `false` jika gagal.

### rmdir(string $path): bool

Menghapus folder dan semua isinya.

### scan(string $path): ?array

Mengambil daftar nama file/folder yang ada di dalam suatu folder. Fungsi ini akan
mengembalikan `null` jika folder `$path` tidak ada, atau array nama file/folder
yang ada di dalam folder `$path` dengan tidak mengikutkan `.` dan `..`.

### write(string $path, string $text): bool

Fungsi untuk membuat dan menulis suatu konten ke dalam suatu file. Perlu diketahui
bahwa fungsi ini akan menindih file target jika sudah ada. Fungsi ini mengembalikan
`true` jika berhasil, dan `false` jika gagal.