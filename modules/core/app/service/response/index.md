---
layout: post
title:  "Service Response"
date:   2015-01-06 10:44:45 +0700
categories: aplikasi service
---

Service response adalah service yang menyediakan method-method dan properti
tentang response yang akan dikirim ke user. Service response bisa diakses dari
kontroler, service, dan middleware dengan perintah `$this->res->$method`.

Method yang disediakan oleh service ini adalah:

### addContent(string $text, bool $truncate=false): void

Menambahkan konten ke response yang akan dikirim. Parameter `$truncate` menentukan
apakah konten sebelumnya harus di tindih, atau ditambahkan.

### addCookie(string $name, string $value, int $expires=604800): void

Fungsi untuk menambahkan cookie ke response. Nilai parameter `$expires` adalah
lamanya cookie disimpan, bukan **tanggal** expired. Contoh nilai yang benar adalah
`(60*60*2)` untuk menyimpan cookie selama 2 jam. Jika cookie dengan nama yang
sama sudah ada, maka cookie yang lama akan ditindih.

### addHeader(string $name, string $value, bool $append=true): void

Fungsi untuk menambahkan header ke response yang akan dikirim. Parameter `$append`
berfungsi untuk menambahkan header walaupun header tersebut sudah ada. Jika nilai
parameter tersebut adalah `false`, maka header dengan nama yang sama yang di set
sebelumnya akan ditindih.

### getCache(): int

Mengambil nilai `$expires` yang diset oleh fungsi `setCache` sebelumnya. Jika
belum pernah diset, maka akan mengembalikan `null`.

### getContent(): string

Mengambil konten yang diset oleh fungsi `addContent` sebelumnya. Jika belum pernah
diset, maka akan mengembalikan nilai *empty string*.

### getCookie(string $name=null)

Mengambil data cookie yang sudah di set sebelumnya. Jika parameter `$name` tidak
di set, maka semua konten cookie yang sudah diset sebelumnya akan dikembalikan.

### getHeader(string $name=null)

Mengambil data header yang diset oleh fungsi `addHeader` sebelumnya. Jika tidak
pernah diset, maka nilai `null` akan dikembalikan. Jika parameter `$name` tidak
di set, maka semua data header yang sudah diset akan dikembalikan. Perlu diketahui
bahwa, ketika data yang diminta ada, maka array akan dikembalikan, walaupun nilai
dari array tersebut hanya satu member.

### getStatus(): int

Mengambil header status kode yang sudah di set.

### redirect($url, $code=302): void

Fungsi meredirect user ke suatu url dengan http header code. Jika nilai `$code`
adalah `200`, maka proses redirect akan menggunakan html/js dengan http header
code 200.

### removeCache(): void

Menghapus data cache yang diset oleh fungsi `setCache` sebelumnya.

### removeContent(): void

Mengosongkan konten yang diset oleh fungsi `addContent` sebelumnya.

### removeCookie(string $name=null): void

Menghapus cookie yang diset oleh fungsi `addCookie` sebelumnya. Jika parameter
`$name` tidak diset, maka semua cookie akan dihapus.

### removeHeader(string $name=null, string $value=null): void

Menghapus header yang diset oleh fungsi `addHeader` sebelumnya. Jika parameter
`$name` tidak diset, maka semua header akan dihapus. Jika parameter `$value` diset
maka hanya nilai tersebut yang akan dihapus jika header dengan nama tersebut memiliki
beberapa nilai.

### render(string $view, array $params=[], string $gate=null): void

Method untuk menggenerasi view, dan menambahkan konten yang digenerasi ke dalam
response. Method ini hanya bisa digunakan jika module `lib-view` terpasang.

### send(bool $callback=true): void

Method untuk mengirimkan konten ke client. Parameter `callback` menentukan apakan
callback event `core.printing` perlu di panggil atau tidak.

### setCache(int $expires): void

Menset cache dan header `ETag`. Nilai parameter `$expires` adalah lamanya konten
akan di cache, bukan **tanggal** expires. Contoh nilai yang benar adalah `(60*60*2)`
untuk mencache selama 2 jam. Method ini bisa digunakan jika module `lib-cache-output`
terpasang.

### setStatus(int $status=200): void

Set header response status code.