<?php

namespace Iankov\AssetV\Models;

class MTime extends Storage
{
    protected $file = 'filemtime.php';

    public function __construct()
    {
        parent::__construct();

        $this->path = $this->dir . '/' . $this->file;
        $this->init();
    }

    public function update($file, $time)
    {
        $this->files[$file] = $time;
    }
}