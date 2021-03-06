<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd9f66577e983584c60b2b86783d79de6
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '667aeda72477189d0494fecd327c3641' => __DIR__ . '/..' . '/symfony/var-dumper/Resources/functions/dump.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\VarDumper\\' => 28,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Mirai\\Wordpress\\' => 16,
            'Mirai\\Core\\' => 11,
            'Mirai\\App\\' => 10,
            'Mirai\\' => 6,
        ),
        'I' => 
        array (
            'Inc2734\\WP_SEO\\' => 15,
            'Inc2734\\WP_OGP\\' => 15,
            'Inc2734\\WP_Breadcrumbs\\' => 23,
        ),
        'D' => 
        array (
            'DebugBar\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Component\\VarDumper\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/var-dumper',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Mirai\\Wordpress\\' => 
        array (
            0 => __DIR__ . '/../../../..' . '/resource/Mirai/wordpress/classes',
        ),
        'Mirai\\Core\\' => 
        array (
            0 => __DIR__ . '/../../../..' . '/resource/Mirai/core/classes',
        ),
        'Mirai\\App\\' => 
        array (
            0 => __DIR__ . '/../../../..' . '/resource/Mirai/app/classes',
        ),
        'Mirai\\' => 
        array (
            0 => __DIR__ . '/../../../..' . '/resource/Mirai',
        ),
        'Inc2734\\WP_SEO\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-seo/src',
        ),
        'Inc2734\\WP_OGP\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-ogp/src',
        ),
        'Inc2734\\WP_Breadcrumbs\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-breadcrumbs/src',
        ),
        'DebugBar\\' => 
        array (
            0 => __DIR__ . '/..' . '/maximebf/debugbar/src/DebugBar',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd9f66577e983584c60b2b86783d79de6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd9f66577e983584c60b2b86783d79de6::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
