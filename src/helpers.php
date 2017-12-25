<?php

/**
 * Generate an asset path using version records.
 *
 * @param  string  $path
 * @param  bool    $secure
 * @return string
 */
if(! function_exists('asset_v')){
    function asset_v($path, $secure = null)
    {
        static $version;
        if(!isset($version)) {
            $version = new \Iankov\AssetV\Models\Version();
        }

        $path = trim($path, '/');
        $ver = $version->file($path);
        if($ver > 0) {
            $path .= '?v' . $ver;
        }

        return asset($path, $secure);
    }
}