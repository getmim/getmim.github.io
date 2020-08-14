---
layout: post
title:  "Gate Kontroler"
date:   2015-01-07 07:44:45 +0700
categories: aplikasi kontroler
---

Masing-masing gate diharapkan memiliki satu main kontroler yang bertugas mengerjakan
hal-hal global gate. Seperti menyediakan handler untuk 404 dan 500. Gate kontroler
boleh di tempatkan dimana saja di aplikasi sementara path ke class tersebut didaftarkan
di konfigurasi module.

Gate kontroler harus extends dari `\Mim\Controller` dan mengimplementasikan interfase
`\Mim\Iface\GateController`.

Karena sudah mengimplementasikan interface tersebut, maka gate kontroler harus
memiliki method-method sebagai berikut:

## Method

### show404(): void

Menampilkan halaman 404. Umumnya fungsi ini hanya memanggil perintah `show404Action`.

### show404Action(): void

Menampilkan halaman 404 dan menset http status jika dibutuhkan.

### show500(object $error): void

Menampilkan error 500. Umumnya fungsi ini hanya meneruskan ke method `show500Action`.

### show500Action(object $error): void

Menampilkan halaman 500.