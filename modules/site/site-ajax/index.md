---
layout: post
title:  "Site Ajax"
date:   2016-01-31 01:01:04 +0700
categories: ext-module site
---

Adalah module helper yang memungkinkan konten html mengambil data dari ajax.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install site-ajax
```

## Konfigurasi

Tambahkan daftar ajax content pada konfigurasi aplikasi/module untuk menentukan
nama dan handler nya seperti di bawah:

```php
return [
    'siteAjax' => [
        'post-trending' => [
            'handler' => 'Class::method',
            'cache' => 86400,
            'view' => 'ajax/content/index'
        ]
    ]
];
```

Bentuk konfigurasi di atas akan mengimplementasikan ajax pada konten dengan sumber data
dari `Class::method` yang akan dikirimkan ke view `ajax/content/index`.

Handler `Class::method` diharapkan mengembalikan nilai array key-value pair yang akan dijadikan
`$params` pada saat generasi view.

## Penggunaan

Tambahkan jQuery dan site-ajax js, dan site-ajax config pada bagian paling bawah html:

```html
<script>
    window.SITE_AJAX = {
        route: '<?= $this->router->to('siteAjaxSingle', ['name'=>'#NAME#']) ?>'
    }
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?= $this->asset('js/site-ajax.js') ?>"></script>
```

Buatkan html element untuk menampung kontent ajax:

```html
<div class="site-ajax"
    data-name="post-trending"
    data-placement="replace"
    data-callback="callbackFn"
    data-device="dth"
></div>
```

Atribute `data-placement` menentukan bagaimana konten ajax ditempatkan relatif ke elemen tersebut, nilai
default adalah `append`. Nilai yang diterima adalah:

1. `replace` Mengganti elemen tersebut dengan konten dari ajax.
1. `append` Menambahkan konten ajax ke dalam child elemen.
1. `after` Menambahkan konten ajax setelah elemen.
1. `before` Menambahkan konten ajax sebelum elemen.
1. `truncate` Menghapus semua child elemen, dan menggantinya dengan konten ajax.

Atribute `data-callback` adalah fungsi javascript yang akan di panggil ketika konten ajax berhasil ditempatkan
dengan parameter pertama adalah elemen yang ditambahkan tersebut.

Atribute `data-device` menentukan device type dimana element ini diproses berdasakan screensize. Nilai dari
atribut ini menerima `d` untuk `desktop`, `t` untuk tablet, dan `h` untuk handphone. Nilai bisa salah satu dari
nilai yang diterima, atau kombinasi ketiganya. Jika tidak di set, maka nilai `dth` akan digunakan. Nilai `dt` berarti
konten diproses hanya pada `desktop` dan `tablet`, sementara `th` akan diproses konten pada `tablet` dan `handphone`.

## Penting

Perlu diketahui, pada saat generasi view, pastikan semua konten disimpan dalam satu elemen parent. Plain text mungkin
akan merusak jQuery html renderer.

Contoh di bawah adalah contoh yang baik:

Semua konten di simpan dalam satu `div` parent element.
```html
<div><!-- any element here --></div>
```

Sementara contoh di bawah adalah contoh yang tidak baik:

Multiple elements:

```html
<div><!-- some content here --></div>
<div><!-- other content here --></div>
```

Tanpa parent element:

```html
<!-- some ontent here -->
```