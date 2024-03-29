---
layout: post
title:  "Form Validator"
date:   2016-01-19 01:01:01 +0700
categories: ext-module
---

Adalah module untuk verifikasi *user submitted data form*. Module ini 
menggunakan library `lib-validator` untuk validasi data.

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-form
```

## Konfigurasi

Semua konfiguasi form disimpan di konfigurasi masing-masing module dengan bentuk
seperti di bawah:

```php
return [
    // ...
    'libForm' => [
        'forms' => [
            '/form-name/' => [
                '@extends' => ['form-name-1', 'form-name-2'],
                '/field-name/' => [
                    'label' => '/Field Label/',
                    'type'  => '/Field Type/',
                    // use only if provided module installed
                    'modules' => ['/module/'],
                    'rules' => [
                        // list of rules
                    ],
                    'filters' => [
                        // list of filters
                    ],
                    'children' => [
                        // list of children if any
                    ]
                ]
            ]
        ]
    ]
    // ...
];
```

Konfigurasi ini menggunakan struktur yang sama persis dengan
[lib-valiator](https://github.com/getmim/lib-validator). Kecuali properti
`label`, `type` yang adalah bagian form field pada saat generasi html input elemnt.

### @extends

Keyword ini digunakan untuk meng-extends rule dan field dari form lain.

## Penggunaan

Ada beberapa cara untuk menggunakan form:

### FormCollection

Cara pertama adalah dengan mengakses langsung class `LibForm\Library\FormCollection`:

```php
use LibForm\Library\FormCollection;

$valid = FormCollection::validate($form_name, $preset_object);
```

### Form

Cara kedua adalah membuat object form sendiri:

```php
use LibForm\Library\Form;

$form = new Form($form_name);
$valid = $form->validate($preset_object);
```

### Service Form

Cara ketiga adalah dengan menggunakan service:

```php
$valid = $this->form->$form_name->validate($preset_object);
```

### Service FormCollection

Cara keempat adalah dengan memanggil langsung fungsi FormCollection
dari service:

```php
$valid = $this->form->validate($form_name, $preset_object);
```

## Method

Di bawah ini adalah daftar method-method yang dimiliki oleh form:

### addError(string $field, string $code, string $text=null): void

Menambahkan manual error pada form. Jika nilai parameter text tidak
didefinisikan, maka properti `text` dari error object diambil dari
translasi berdasarkan error code. Sebagai catatan bahwa menambahkan
error melalui metode ini tidak akan mengirimkan informasi rule pada
translasi.

### csrfField(string $name='CSRFToken'): string

Menggenerasi html input hidden untuk token csrf prevention.

### csrfTest(string $name='CSRFToken'): bool

Menguji nilai csrf yang dikirimkan oleh form dari browser.

### csrfToken(): string

Mengambil nilai token untuk csrf.

### field(string $name, $options=null): string

Menggenerasi html input berdasarkan konfigurasi field pada form rules. Fungsi ini akan
menggenerasi theme file di `./theme/[GATE]/form/field/[type].phtml` dengan tembusan
parameter `field`, `options`, `value`, dan `form`.

### fieldExists(string $name): bool

Mengecek jika suatu field ada pada form ini.

### getError(string $field): ?object

Mengambil informasi error field, jika ada.

### getErrors(): array

Mengambil semua error yang terjadi pada form.

### getFields(): object

Mengambil semua field yang akan di proses oleh module.

### getName(): string

Mengambil nama form.

### getResult(): ?object

Mengambil hasil akhir validasi form.

### hasError(): ?bool

Mengecek jika ada error pada form.

### setObject(object $object): void

Menset default form object.

### validate(object $object=null): ?object

Memvalidasi object dan mengembalikan data sesuai dengan method `getResult()`.
