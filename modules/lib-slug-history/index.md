---
layout: post
title:  "Slug History"
date:   2016-01-27 01:01:04 +0700
categories: ext-module
---

Adalah module yang menyimpan history perubahan slug/name suatu object
di database untuk memastikan search enginer atau user tidak kehilangan
trak halaman ketika nama atau slug halaman tersebut diubah.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-slug-history
```

## Penggunaan

Module ini membuat satu library dengan nama `LibSlugHistory\Library\SlugHistory` 
yang bisa digunakan untuk memenej slug history.

```php
use LibSlugHistory\Library\SlugHistory;

// cek dan redirect ke halaman baru jika ada, atau
// return false jika tidak ada perubahan slug
SlugHistory::goto(
    '$group',
    'current_slug',
    'routerName',
    ['router'=>'param']
);

// menambah satu history
SlugHistory::create(
    '$group',
    '$object-identity',
    '$old_slug',
    '$new_slug'
);
```

## Method

Library ini memiliki method sebagai berikut:

### create(string $group, string $id, string $old, string $new): bool

Menambah satu slug history baru dengan parameter sebagai berikut:

1. `group::STRING` Nama grup koleksi slug ini, contoh `user`, atau `post`.
1. `id::STRING` Identitas unik objek ini, contoh `user->id`, atau `post->id`.
1. `old::STRING` Slug/name yang lama.
1. `new::STRING` Slug/name yang baru.

### get(string $group, string $slug): ?object

Mengambil target redirect suatu slug lama. Fungsi ini akan mengembalikan object slug
yang paling terakhir yang bisa digunakan untuk meredirect user. Atau null jika
tidak ada.

### goto(string $group, string $slug, string $route, array $params): bool

Me-redirect user ke halaman slug history paling terakhir jika ada, atau mengembalikan
nilai false jika tidak ditemukan history.

Fungsi ini menerima parameter:

1. `group::STRING` Nama group koleksi slug.
1. `slug::STRING` Slug yang akan di cek.
1. `route::STRING` Nama route kemana user akan diredirect.
1. `params::ARRAY` Array key-value pair yang akan diteruskan pada saat generasi url redirect.

```php
SlugHistory::goto('post', 'my-first-post', 'sitePostSingle', [
    'slug' => '$',
    'otherparams' => 'otherparams_value'
]);
```

Nilai `$` pada params akan diubah menjadi nilai slug yang terbaru.

Jika route ditemukan, maka fungsi ini akan langsung meredirect dengan http status
code `301` dan langsung `exit`. Semua query parameter yang sedang terjadi juga
akan digunakan pada saat redirect.

### index(string $group, string $id): array

Mengambil semua slug history suatu object pada suatu group.

### remove(string $group, string $id): void

Menghapus semua slug history suatu objek.