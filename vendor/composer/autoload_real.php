<?php

// autoload_real.php generated by Composer

class ComposerAutoloaderInit01b88def4858bed523bcc89408d88ef6
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('CentComposer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit01b88def4858bed523bcc89408d88ef6', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \CentComposer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit01b88def4858bed523bcc89408d88ef6', 'loadClassLoader'));

        $vendorDir = dirname(__DIR__);
        $baseDir = dirname($vendorDir);

        $map = require __DIR__ . '/autoload_namespaces.php';
        foreach ($map as $namespace => $path) {
            $loader->add($namespace, $path);
        }

        $classMap = require __DIR__ . '/autoload_classmap.php';
        if ($classMap) {
            $loader->addClassMap($classMap);
        }

        $loader->register(true);

        return $loader;
    }
}
