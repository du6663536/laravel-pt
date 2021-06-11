## Modules 框架初始化

一、服务器要求
-   PHP >= 7.2.5
-   BCMath PHP 拓展
-   Ctype PHP 拓展
-   JSON PHP 拓展
-   Mbstring PHP 拓展
-   OpenSSL PHP 拓展
-   PDO PHP 拓展
-   Tokenizer PHP 拓展
-   XML PHP 拓展

二、通过 Composer 创建项目
    ```
    composer create-project --prefer-dist laravel/laravel blog "6.*"
    ```
    （推荐 composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ ）
    （ https://packagist.phpcomposer.com  这个不太好用，慢而且容易卡死失败）
    注意：在windows 环境下，如果composer 操作是在docker容器中进行的，后续会有换行符问题。

三、重要文件配置
    .env
    config/app.php
        时区（'timezone' => 'Asia/Shanghai',）



## Modules 使用说明

[使用参考链接](https://learnku.com/articles/6153/laravel-modular-development)

一、安装
    ```
    composer require nwidart/laravel-modules
    ```

二、发布软件包的配置，通过运行以下方式
    ```
    php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"
    ```
    执行完上面这条命令之后，在 config 文件夹下会生成一个 modules.php 文件，这个是模块开发的配置文件，你可以在这里面进行配置。

三、添加自动加载
    ```
    composer dump-autoload
    ```

四、生成模块
```bash
php artisan module:make module-name
php artisan module:make module-name1 module-name2 module-name3
```

五、模块中使用artisan(不建议使用migration)
```bash
php artisan module:make-controller Basics Frame
php artisan module:make-model CommonMember Member
php artisan module:make-migration create_images_table Demo
php artisan module:migrate Demo
```

- **[Vehikl](https://vehikl.com/)**


- [OP.GG](https://op.gg)


## mysql数据库
-sql调试
-方法一     App\Providers\AppServiceProvider.php 或者指定模块 Modules\Member\Providers\MemberServiceProvider 添加监控
-方法二     $user  = DB::table('common_member')->where(['member_id' => 2])->dd(); 或 $user  = DB::table('common_member')->where(['member_id' => 2])->dump();    




## 依赖说明
```bash
-安装依赖
#安装一个新的依赖到require中
composer require
#安装一个新的依赖到require_dev中
composer require_dev
```
