<?php

namespace Iankov\AssetV\Models;

class Version extends Storage
{
    protected $file = 'fileversion.php';

    public function __construct()
    {
        parent::__construct();

        $this->path = $this->dir . '/' . $this->file;
        $this->init();
    }

    public function update($file)
    {
        if(isset($this->files[$file])){
            $this->files[$file]++;
        }else{
            $this->files[$file] = 0;
        }
    }
}