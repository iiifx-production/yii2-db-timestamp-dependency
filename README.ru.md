# yii2-db-timestamp-dependency

[![Latest Version on Packagist](https://img.shields.io/packagist/v/iiifx-production/yii2-db-timestamp-dependency.svg?style=flat-square)](https://packagist.org/packages/iiifx-production/yii2-db-timestamp-dependency)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/iiifx-production/yii2-db-timestamp-dependency.svg?style=flat-square)](https://packagist.org/packages/iiifx-production/yii2-db-timestamp-dependency)

## Установка

Через Composer

``` bash
$ composer require iiifx-production/yii2-db-timestamp-dependency
```

или

``` json
"require": {
    "iiifx-production/yii2-db-timestamp-dependency": "*"
},
```

## Использование

``` php
$postModelList = Yii::$app->db->cache( function () {
    return PostModel::find()
        ->with( [ 'postContentModel' ] )
        ->where( [ 'is_active' => 1 ] )
        ->all();
}, 0, new DbTimestampDependency( [
    'table' => [
        PostModel::tableName(),
        PostContentModel::tableName(),
    ],
] ) );
```

## Автор

- [Vitaliy IIIFX Khomenko](https://github.com/iiifx)

## Лицензия

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.