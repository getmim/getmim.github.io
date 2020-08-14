---
layout: post
title:  "Event"
date:   2016-01-09 01:01:02 +0700
categories: ext-module
---

Adalah module yang memungkinkan memanggil suatu event ketika suatu kejadian
terjadi pada aplikasi, dan memanggil handler listener.

## instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-event
```

## penggunaan

Module ini menambahkan satu library umum dengan nama `LibEvent\Library\Event`
yang bisa digunakan untuk men-trigger suatu event.

```php
use LibEvent\Library\Event;

$data = [
    'data' => 'to',
    'send' => 'to',
    'the' => 'handler'
];

Event::trigger('event-name', $data);
```

Atau bisa juga melalui service dengan nama `event`:

```php

    // controller body
    $this->event->trigger('event-name', $data);
    // ...
```

## konfigurasi

Masing-masing listener event di daftarkan di konfigurasi sebagai berikut:

```php
return [
    // configuration
    'libEvent' => [
        'events' => [
            'event-name' => [
                'Class::method' => true
            ]
        ]
    ]
];
```