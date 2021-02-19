# laravel-tencent-cloud

This is a tencent cloud expansion for the laravel

[![License](https://poser.pugx.org/larva/laravel-tencent-cloud/license.svg)](https://packagist.org/packages/larva/laravel-tencent-cloud)
[![Latest Stable Version](https://poser.pugx.org/larva/laravel-tencent-cloud/v/stable.png)](https://packagist.org/packages/larva/laravel-tencent-cloud)
[![Total Downloads](https://poser.pugx.org/larva/laravel-tencent-cloud/downloads.png)](https://packagist.org/packages/larva/laravel-tencent-cloud)

## 环境需求

- PHP >= 7.0

## Installation

```bash
composer require larva/laravel-tencent-cloud
```

## for Laravel

This service provider must be registered.

```php
// config/app.php

'providers' => [
    '...',
    Larva\TencentCloud\TencentCloudServiceProvider::class,
];
```


## Use

```php
try {
	$cdn = TencentCloud::get('cdn');
	$cdn->RefreshObjectCaches([
		'ObjectPath' => [
			'http://www.baidu.com',
		],
		'ObjectType' => 'File'
	]);
} catch (\Exception $e) {
	print_r($e->getMessage());
}
```