<?php

return [
    'id' => 'yii2-user-tests',
    'basePath' => dirname(__DIR__),
    'language' => 'en-US',
    'aliases' => [
        '@tests' => dirname(dirname(__DIR__)),
        '@vendor' => VENDOR_DIR,
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
    ],
    'components' => [
		'wordCounter' => [
			'class' => \prokhonenkov\wordcounter\WordCounter::class,
		],
        'urlManager' => [
            'showScriptName' => true,
        ],
    ],
    'params' => [],
];
