<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf2104b36a71c1b06475b9570b83a58db
{
    public static $classMap = array (
        'Money' => __DIR__ . '/../..' . '/src/Money.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitf2104b36a71c1b06475b9570b83a58db::$classMap;

        }, null, ClassLoader::class);
    }
}
