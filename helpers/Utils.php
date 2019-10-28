<?php

namespace Elderbraum\Vvi\Helpers;

class Utils
{
    protected static $plugin_path_cache = null;
    
    public static function getPluginDir()
    {
        if (null !== static::$plugin_path_cache) {
            return static::$plugin_path_cache;
        }
        return static::$plugin_path_cache = plugin_dir_path(DJC_VVI_FILE);
    }
}
