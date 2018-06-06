<?php

define('YII_DEBUG', true);
error_reporting(E_ERROR);

require_once '../vendor/autoload.php';
require_once '../vendor/yiisoft/yii2/Yii.php';

use Hejiang\UploadedFile\UploadedFile;
use Hejiang\Storage\Components\StorageComponent;

$storageConfig = [
    'class' => 'Hejiang\Storage\Components\StorageComponent',
    'basePath' => 'temp/',
    'driver' => [
        'class' => 'Hejiang\Storage\Drivers\Local',
        'accessKey' => '',
        'secretKey' => '',
        'bucket' => '',
        //'urlTemplate' => '?a=1',
    ]
];

$app = new \yii\web\Application(
    [
        'id' => 'basic',
        'language' => 'zh-CN',
        'timeZone' => 'Asia/Shanghai',
        'basePath' => __DIR__,
        'components' => [
            'storage' => $storageConfig
        ]
    ]
);

/** @var StorageComponent */
$storage = \Yii::$app->storage;

/** @var UploadedFile */
$test = $storage->getUploadedFile('test');

$res = $test->saveWithOriginalExtension('test');

var_dump($res);