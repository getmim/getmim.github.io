---
layout: post
title:  "ADB"
date:   2016-01-29 01:01:04 +0700
categories: ext-module
---

Module untuk bekerja dengan android adb

## Instalasi

```
mim app install lib-adb
```

## Konfigurasi

Tambahkan konfirugasi seperti di bawah pada konfigurasi aplikasi:

```
return [
    'libAdb' => [
        'bin' => '/path/to/adb/binary'
    ]
];
```

## Classes

### LibAdb\Library\Adb

1. `:exec(string $command): ?string`
2. `:devices(bool $long = false): array`
3. `:getName(string $id): ?string`
