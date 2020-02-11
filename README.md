Word counter
==============
This extension count words and sort them by the number and alphabet. 

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require prokhonenkov/yii2-word-counter 
```

or add

```
"prokhonenkov/yii2-word-counter": "*"
```

to the require section of your `composer.json` file.

Configuration
-------------

Add component declaration to your config file for console config:
```php
<?php

return [
    // ... your config
    'components' => [
        'wordCounter' => [
            'class' => \prokhonenkov\wordcounter\WordCounter::class,
        ],
    ]
];

```

Usage
-----

Pass filepath to setFilePath method and invoke count method. 
```php
class TextController extends \yii\console\Controller
{
    public function actionCountWords(string $fileName)
    {
        $result = \Yii::$app->wordCounter
			->setFilePath($fileName)
			->count();

        print_r($result);
    }
}
```  