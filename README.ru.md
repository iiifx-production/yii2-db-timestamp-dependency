# yii2-db-timestamp-dependency

[![Latest Version on Packagist](https://img.shields.io/packagist/v/iiifx-production/yii2-db-timestamp-dependency.svg?style=flat-square)](https://packagist.org/packages/iiifx-production/yii2-db-timestamp-dependency)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/iiifx-production/yii2-db-timestamp-dependency.svg?style=flat-square)](https://packagist.org/packages/iiifx-production/yii2-db-timestamp-dependency)

## Установка

Через Composer

``` bash
$ composer require iiifx-production/yii2-db-timestamp-dependency
```

Или

``` json
"require": {
    "iiifx-production/yii2-db-timestamp-dependency": "*"
},
```

## Usage

``` php
$cachedData = Yii::$app->db->cache( function () {
    // ...
}, 0, new DbTimestampDependency( [
    'table' => [
        PostModel::tableName(),
        PostContentModel::tableName(),
    ],
] ) );
```

## Credits

- [Vitaliy IIIFX Khomenko](https://github.com/iiifx)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.