# Laravel autoload


+ laravel加载文件`public/index.php` 第一句：`require __DIR__.'/../bootstrap/autoload.php';`

+ 文件`bootstrap/autoload.php` ： `require __DIR__.'/../vendor/autoload.php';`

+ 文件`vendor/autoload.php`: 

```
require_once __DIR__ . '/composer/autoload_real.php';

return ComposerAutoloaderInit58b422aaaf203dfbbb950ab867cda0a3::getLoader();
```
**`autoload_real.php`文件中的类即是，`ComposerAutoloaderInit58b422aaaf203dfbbb950ab867cda0a3`**

+ 文件`vendor/composer/autoload_real.php`:

```

class ComposerAutoloaderInit58b422aaaf203dfbbb950ab867cda0a3
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit58b422aaaf203dfbbb950ab867cda0a3', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit58b422aaaf203dfbbb950ab867cda0a3', 'loadClassLoader'));

// php版本大于等于5.6 且不是hvvm引擎，且没有安装zend loader件
        $useStaticLoader = PHP_VERSION_ID >= 50600 && !defined('HHVM_VERSION') && (!function_exists('zend_loader_file_encoded') || !zend_loader_file_encoded());
        if ($useStaticLoader) {
        
            //如果是，加载静态文件
            require_once __DIR__ . '/autoload_static.php';
            
           //调用autoload_static.php的getInitializer方法，将$this，变量属性绑定到ClassLoader.php中类ClassLoader
            call_user_func(\Composer\Autoload\ComposerStaticInit58b422aaaf203dfbbb950ab867cda0a3::getInitializer($loader));
            
        } else {
            $map = require __DIR__ . '/autoload_namespaces.php';
            foreach ($map as $namespace => $path) {
                $loader->set($namespace, $path);
            }

            $map = require __DIR__ . '/autoload_psr4.php';
            foreach ($map as $namespace => $path) {
                $loader->setPsr4($namespace, $path);
            }

            $classMap = require __DIR__ . '/autoload_classmap.php';
            if ($classMap) {
                $loader->addClassMap($classMap);
            }
        }

        $loader->register(true);

        if ($useStaticLoader) {
        
        //加载autoload_static.php 当中file属性
            $includeFiles = Composer\Autoload\ComposerStaticInit58b422aaaf203dfbbb950ab867cda0a3::$files;
        } else {
        
        //加载autoload_files.php文件
            $includeFiles = require __DIR__ . '/autoload_files.php';
        }
        //循环加载请求实际文件
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire58b422aaaf203dfbbb950ab867cda0a3($fileIdentifier, $file);
        }

        return $loader;
    }
}

function composerRequire58b422aaaf203dfbbb950ab867cda0a3($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        require $file;

        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;
    }
}

```

composer文件夹下的文件分别是:
`autoload_classmap.php`,`autoload_files.php`,`autoload_namespaces.php`,`autoload_psr4.php`,`autoload_static.php`,`autoload_real.php`,`ClassLoader.php `

如果php>=5.6，没有使用hvvm，zend等，将static中的属性绑到ClassLoader类中；
否则，分别加载`autoload_namespaces.php`,`autoload_psr4.php`,`autoload_classmap.php`文件，绑到`ClassLoader`对应的属性上

ClassLoader.php   实现了PSR-0，PSR-4和类映射类加载器。

