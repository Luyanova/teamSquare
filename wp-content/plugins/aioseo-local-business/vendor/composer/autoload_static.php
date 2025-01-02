<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9b52e7cfccfb74f4c995ab3549d84be9
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'AIOSEO\\Plugin\\Addon\\LocalBusiness\\' => 34,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'AIOSEO\\Plugin\\Addon\\LocalBusiness\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9b52e7cfccfb74f4c995ab3549d84be9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9b52e7cfccfb74f4c995ab3549d84be9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9b52e7cfccfb74f4c995ab3549d84be9::$classMap;

        }, null, ClassLoader::class);
    }
}
