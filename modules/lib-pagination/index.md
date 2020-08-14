---
layout: post
title:  "Pagination"
date:   2016-01-06 01:01:02 +0700
categories: ext-module
---

Library yang menyediakan pagination calculator.

## instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-pagination
```

## penggunaan

Semua aktifitas dengan redis dilayani melalu library dengan nama
`LibPagination\Library\Paginator`.

```php
use LibPagination\Library\Paginator;

$pages = new Paginator(
    $base_url,
    $total_items,
    $current_page,
    $items_per_page,
    $page_link_to_show,
    $query_parameters,
    $prev_label,
    $next_label
);

foreach($pages as $page){
    $page->label;
    $page->link;
    $page->active;
    $page->prev_btn;
    $page->next_btn;
}
```

dengan keterangan sebagai berikut:

1. base_url. URL ke main konten.
1. total_items. Total item yang akan dipaginasi.
1. current_page. Halaman sekarang yang sedang aktif. Default 1.
1. items_per_page. Total item per halaman. Default 12.
1. page_link_to_show. Total link pagination yang akan ditampilkan. Default 10.
1. query_parameters. Tambahan query parameters. Default [].
1. prev_label. Label untuk link previous page. Default '&amp;#171;'.
1. next_label. Label untuk link next page. Default '&amp;#187;'.

## method

### getFirst(): ?object
### getLast(): ?object
### getPrev(): ?object
### getNext(): ?object