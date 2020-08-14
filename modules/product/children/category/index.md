---
layout: post
title:  "Product Category"
date:   2016-01-14 01:01:02 +0700
categories: ext-module product
---

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install product-category
```

## Custom Field

Untuk tambahan field, pastikan menambahkan konfigurasi field pada form 
`admin.product-category.edit` dengan tambahan property `xpos` yang menerima
nilai salah satu dari `right-top`, `right-bottom`, `left-bottom-left`, `left-bottom-right`

```php
return [
    'libForm' => [
        'forms' => [
            'admin.product-category.edit' => [
                'image' => [
                    'label' => 'Image',
                    'type' => 'image',
                    'form' => 'std-image',
                    'rules' => [],
                    'xpos' => 'left-bottom-left'
                ]
            ]
        ]
    ]
];
```