<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2019b37d70e814d78445181e85700db9
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'ValidatorFilterPHP\\' => 19,
        ),
        'D' => 
        array (
            'Dcblogdev\\PdoWrapper\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ValidatorFilterPHP\\' => 
        array (
            0 => __DIR__ . '/..' . '/mahmoud-abdelfadeil/validator-filter-php/src',
        ),
        'Dcblogdev\\PdoWrapper\\' => 
        array (
            0 => __DIR__ . '/..' . '/dcblogdev/pdo-wrapper/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2019b37d70e814d78445181e85700db9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2019b37d70e814d78445181e85700db9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2019b37d70e814d78445181e85700db9::$classMap;

        }, null, ClassLoader::class);
    }
}
