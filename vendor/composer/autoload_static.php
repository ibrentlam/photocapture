<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit576afbc1dd6516ffee01851a2d0dac32
{
    public static $prefixesPsr0 = array (
        'U' => 
        array (
            'Unirest\\' => 
            array (
                0 => __DIR__ . '/..' . '/mashape/unirest-php/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit576afbc1dd6516ffee01851a2d0dac32::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}