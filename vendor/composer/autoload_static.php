<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2019b37d70e814d78445181e85700db9
{
    public static $files = array (
        'ef37c23e070fb19294c4aa65c971aec3' => __DIR__ . '/../..' . '/app/Helpers/helper.php',
        '7b6da17ee52fc1de63821b4ffee602db' => __DIR__ . '/../..' . '/config/app.php',
    );

    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'ValidatorFilterPHP\\' => 19,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ValidatorFilterPHP\\' => 
        array (
            0 => __DIR__ . '/..' . '/mahmoud-abdelfadeil/validator-filter-php/src',
        ),
        'App\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit2019b37d70e814d78445181e85700db9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2019b37d70e814d78445181e85700db9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2019b37d70e814d78445181e85700db9::$classMap;

        }, null, ClassLoader::class);
    }
}
