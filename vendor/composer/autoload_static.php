<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf9e692937d38c40f41696b2c2c3b1ac8
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'HaroldKerry\\MsisdnNetworkDetector\\' => 34,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'HaroldKerry\\MsisdnNetworkDetector\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf9e692937d38c40f41696b2c2c3b1ac8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf9e692937d38c40f41696b2c2c3b1ac8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf9e692937d38c40f41696b2c2c3b1ac8::$classMap;

        }, null, ClassLoader::class);
    }
}
