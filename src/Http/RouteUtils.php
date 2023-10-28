<?php

namespace App\Http;

trait RouteUtils
{
    public static $useRouter;

    public static function prefix($name)
    {
        self::$useRouter->currentGroup = $name;
        return self::$useRouter;
    }

    public static function listFolderRoutes($path)
    {
        $files = glob($path . '/*.php');
        foreach ($files as $file) {
            if (basename($file) != "web.php") {
                self::$useRouter->currentGroup = '/' . str_replace(".php", "", basename($file));
                require_once $file;
            } else {
                self::$useRouter->currentGroup = "";
                require_once $file;
            }
        }
    }

    public static function add($cb = null)
    {
        require_once $cb;
    }
}
