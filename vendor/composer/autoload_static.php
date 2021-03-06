<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit69714a439446f5439ef18c3ea4455669
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Predis\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Predis\\' => 
        array (
            0 => __DIR__ . '/..' . '/predis/predis/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit69714a439446f5439ef18c3ea4455669::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit69714a439446f5439ef18c3ea4455669::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
