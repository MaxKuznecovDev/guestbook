<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7bb30d0d280df91476a50447d6e1c1e0
{
    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'project\\' => 8,
        ),
        'c' => 
        array (
            'core\\mvc\\' => 9,
            'core\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'project\\' => 
        array (
            0 => __DIR__ . '/../..' . '/project',
        ),
        'core\\mvc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core/mvc',
        ),
        'core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
    );

    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'Monolog' => 
            array (
                0 => __DIR__ . '/..' . '/monolog/monolog/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7bb30d0d280df91476a50447d6e1c1e0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7bb30d0d280df91476a50447d6e1c1e0::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit7bb30d0d280df91476a50447d6e1c1e0::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit7bb30d0d280df91476a50447d6e1c1e0::$classMap;

        }, null, ClassLoader::class);
    }
}