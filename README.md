# log-notify-laravel
支持laravel monolog记录错误日志时通知报警，本仓库依赖于[jathamj/log-notify](https://github.com/JathamJ/log-notify)

### 安装
```shell
composer require jathamj/log-notify-laravel
```

### 使用

1.在 项目根目录/config 目录下新增配置文件 logging_notify.php ，配置参考[jathamj/log-notify](https://github.com/JathamJ/log-notify)
```php
return [

    //通知接口
    'api'    => array(
        'default'   => [
            'type'              => 'dingtalk',  //通知接口类型（钉钉）
            'access_token'      => '983d92ec8a7594b927babe9fdbbad116871828f538cb18ab5ebe742547e241c6',
            'secret'            => 'SECc2e0ff9e530b5f2666a023be29f289f146f91fdfe0207e5e3d0e883e11951cf7',
        ],
    ),

    //缓存
    'redis'     => [
        'host'  => '127.0.0.1',
        'port'  => 6379,
    ],

    //报警模块
    'modules'    => array(
        'default'   => [
            'api'               => 'default',    //通知接口 (对应api配置)
            'label'             => '订单中心',    //客户化名称
            'interval'          => 3600,        //统计周期
            'times'             => 3,           //warning触发报警次数
            'frequency'         => 600,         //warning报警间隔
            'error.frequency'   => 1,           //error报警间隔
        ],
    ),
];
```
2.修改 config/logging.php 文件，相应driver新增tap配置
```php
return [
            [
                'driver' => 'single',
                'path' => storage_path('logs/laravel.log'),
                'level' => 'debug',
                'tap'   => [Jathamj\LogNotifyLaravel\NotifyFormatter::class],
            ],
        ...
       ];
```
