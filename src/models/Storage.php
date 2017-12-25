<?php

namespace Iankov\AssetV\Models;

class Storage
{
    protected $files = [];
    protected $dir = '';
    protected $file = '';
    protected $path = '';

    public function __construct()
    {
        $this->dir = storage_path('assetv');
    }

    protected function init()
    {
        if (is_file($this->path) && is_readable($this->path)) {
            include($this->path);
            $this->files = isset($data) ? $data : [];

            /*$lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (preg_match('/(.*):([0-9]+)/i', $line, $match)) {
                    $this->files[$match[1]] = $match[2];
                }
            }*/
        }
    }

    public function file($file = null)
    {
        return array_get($this->files, $file, 0);
    }

    public function files()
    {
        return $this->files;
    }

    public function store()
    {
        if (!is_dir($this->dir)) {
            mkdir($this->dir, 0755, true);
        }

        /*$content = '';
        foreach ($this->files as $file => $time) {
            $content .= $file . ':' . $time . "\n";
        }

        file_put_contents($this->path, $content);*/

        file_put_contents($this->path, '<?php $data = '.var_export($this->files, true).';');
    }
}