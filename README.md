# yii2-db-timestamp-dependency

[![Latest Version on Packagist](https://img.shields.io/packagist/v/league/:package_name.svg?style=flat-square)](https://packagist.org/packages/league/:package_name)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/thephpleague/:package_name/master.svg?style=flat-square)](https://travis-ci.org/thephpleague/:package_name)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/thephpleague/:package_name.svg?style=flat-square)](https://scrutinizer-ci.com/g/thephpleague/:package_name/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/thephpleague/:package_name.svg?style=flat-square)](https://scrutinizer-ci.com/g/thephpleague/:package_name)
[![Total Downloads](https://img.shields.io/packagist/dt/league/:package_name.svg?style=flat-square)](https://packagist.org/packages/league/:package_name)

**Note:** Replace ```:author_name``` ```:author_username``` ```:author_website``` ```:author_email``` ```:package_name``` ```:package_description``` with their correct values in [README.md](README.md), [CHANGELOG.md](CHANGELOG.md), [CONTRIBUTING.md](CONTRIBUTING.md), [LICENSE.md](LICENSE.md) and [composer.json](composer.json) files, then delete this line.

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install

Via Composer

``` bash
$ composer require iiifx-production/yii2-db-timestamp-dependency
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