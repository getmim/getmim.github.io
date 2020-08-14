---
layout: post
title:  "Service Router"
date:   2015-01-06 11:44:45 +0700
categories: aplikasi service
---

Adalah service yang menyediakan fungsi untuk menggenerasi url ke suatu route. Service
ini bisa diakses dari aplikasi dengan perintah `$this->router`.

## Method

Service ini menyediakan beberapa method yang bisa digunakan, yaitu:

### asset(string $gate, string $path, int $version): ?string

Mengambil link ke aset/static file suatu gate.

### exists(string $name): bool

Mengecek jika route dengan nama `$name` terdaftar.

### getParam(string $name): ?string

Fungsi untuk mengambil parameter yang sudah diset sebelumnya.

### setParam(string $name, string $value): void

Fungsi untuk mengeset suatu nilai parameter generator router url. Nilai yang diset
di sini akan digunakan oleh method `to` pada saat menggenerasi suatu URL jika
parameter `$params` tidak ditemukan.

### to(string $name, array $params=[], array $query=[]): ?string

Fungsi untuk menggenerasi url ke suatu route. Nilai `params` adalah key-value
pair di mana `key` adalah nama param url, dan `value` adalah nilai nya. Jika
param yang dibutuhkan tidak ditemukan di parameter `$params`, maka fungsi ini
mencoba mencari dari parameter yang diset sebelumnya menggunakan fungsi `setParam`.

```php
// siteUserSingle
//  path => '/user/:name'
$next = $this->router->to('siteUserSingle', ['name'=>'mim']);
```