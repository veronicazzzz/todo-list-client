<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit796fcef52ba0bb436d317b0daed9b12d
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Veronicazzzz\\TodoListClient\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Veronicazzzz\\TodoListClient\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit796fcef52ba0bb436d317b0daed9b12d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit796fcef52ba0bb436d317b0daed9b12d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit796fcef52ba0bb436d317b0daed9b12d::$classMap;

        }, null, ClassLoader::class);
    }
}