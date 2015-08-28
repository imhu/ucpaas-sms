# ucpaas-sms
云之讯 短信Api
修改自：hardywen/ucpaas-sms
在这基础上升级到了laravel5

#安装 
在composer.json 添加 
```json
imhu/ucpaas-sms: '~1.0'
```

运行 ```composer update```

在 ```app/config/app.php```的providers数组里加入
```php
Hardywen\UcpaasSms\UcpaasSmsServiceProvider::class,
```
aliases 数组里加入
```php
'UcpaasSms' => Hardywen\UcpaasSms\Facade\UcpaasSms::class,
```

运行
```php 
php artisan vendor:publish
```

去 ```app/config/ucpaas.php``` 配置

#使用
发送手机短信
```php
UcpaasSms::templateSMS('9635', '123456,3', '138xxxxxx')
```

发送语音验证码
```php
UcpaasSms::voiceCode('123123','138xxxx')
```
