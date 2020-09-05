---
layout: post
title:  "Validator Error Code"
date:   2016-01-17 01:01:02 +0700
categories: ext-module
---

## Error Code

Masing-masing error harus memiliki error code. Dan di bawah ini adalah error
code yang sudah di daftarkan oleh module ini. Jika membuat custom error, pastikan
menggunakan error code yang belum ada di bawah. Dan masing-masing validator harus
menggunakan nilai error yang berbeda:

number  | rule      | description
--------|-----------|------------
1.0     | array     | Not an array
1.1     | array     | Not indexed array
1.2     | array     | Not assoc array
2.0     | date      | Not a date, or invalid format
2.1     | date      | Wrong date format
2.2     | date      | Date too early
2.3     | date      | Date too far
3.0     | email     | Not an email
4.0     | in        | Not in array
5.0     | ip        | Not an IP
5.1     | ip        | Not an IPv4
5.2     | ip        | Not an IPv6
6.0     | length    | Too short
6.1     | length    | Too long
7.0     | notin     | Object in array
8.0     | numeric   | Not numeric
8.1     | numeric   | Too less
8.2     | numeric   | Too great
8.3     | numeric   | Decimal point not match
9.0     | object    | Not an object
10.0    | regex     | Not match
11.0    | required  | Not present
12.0    | text      | Not a text
12.1    | text      | Not a slug
12.2    | text      | Not an alnumdash
12.3    | text      | Not an alpha
12.4    | text      | Not an alnum
13.0    | url       | Not an URL
13.1    | url       | Don't have path
13.2    | url       | Don't have query
13.3    | url       | Required query not present
21.0    | empty     | The value is empty
21.1    | empty     | The value is not empty
23.1    | json      | The value is not valid json string
25.0    | config    | The valus is not in acceptable value
25.1    | config    | The value is not in acceptable list values
25.2    | config    | The value is not match with requested value
26.1    | equals_to | Is not equals to references field

Module-module lain yang juga mendaftarkan error code adalah sebagai berikut:

number | rule        | module           | description
-------|-------------|------------------|------------
14.0   | unique      | lib-model        | Not unique.
15.0   | upload-form | lib-upload       | Upload form not found.
16.0.1 | upload-file | lib-upload       | File size too small.
16.0.2 | upload-file | lib-upload       | File size too big.
16.1   | upload-file | lib-upload       | Mime type not accepted.
16.2   | upload-file | lib-upload       | File extension not accepted.
16.3.1 | upload-file | lib-upload       | File image width too small.
16.3.2 | upload-file | lib-upload       | File image width too big.
16.4.1 | upload-file | lib-upload       | File image height too small.
16.4.2 | upload-file | lib-upload       | File image height too big.
27.0   | upload-file | lib-upload       | PHP Error: Unknown error
27.1   | upload-file | lib-upload       | PHP Error: File size to big ( php.ini )
27.2   | upload-file | lib-upload       | PHP Error: File size to big ( MAX_FILE_SIZE  )
27.3   | upload-file | lib-upload       | PHP Error: Partially uploaded
27.4   | upload-file | lib-upload       | PHP Error: No file uploaded
27.5   | upload-file | lib-upload       | PHP Error: No /tmp dir
27.6   | upload-file | lib-upload       | PHP Error: Unabel to write to disk
27.7   | upload-file | lib-upload       | PHP Error: Blocked by extension
17.0   | upload      | lib-upload       | File target not found.
17.1   | upload      | lib-upload       | Target file not acceptable.
18.0   | upload-list | lib-upload       | One or more file not found.
18.1   | upload-list | lib-upload       | One or more file not acceptable.
18.2   | upload-list | lib-upload       | Invalid format data posted.
19.0   | exists      | lib-model        | Object not exists on db.
20.0   | exists-list | lib-model        | One or more object not exists on db.
22.0   | enum        | lib-enum         | Selected enum key is not found.
22.1   | enum        | lib-enum         | Selected value is not in options list.
22.2   | enum        | lib-enum         | One or more selected value is not in options list.
24.0   | creditcard  | lib-creditcard   | Provided value is not valid credit card number.
24.1   | creditcard  | lib-creditcard   | Provided value is not as of rule credit card provider.

Untuk menambahkan error code yang lain, pastikan menambahkan nilai
seperti di bawah pada konfigurasi module:

```php
// ...
    'libValidator' => [
        'errors' => [
            '20.0' => 'language.error.transaltion_key'
        ]
    ]
// ...
```

Selain itu, module juga diharapkan menambahkan locale nya sendiri.
Silahkan mengacu pada [lib-locale](https://github.com/getmim/lib-locale)
untuk menambahkan locale untuk error tersebut.