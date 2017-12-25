<?php

namespace Iankov\AssetV\Commands;

use Iankov\AssetV\Models\MTime;
use Iankov\AssetV\Models\Version;
use Illuminate\Console\Command;

class AssetvUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assetv:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find files modifications and update version';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->mtime = new MTime();
        $this->version = new Version();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $assetsPath = rtrim(config('assetv.assets_path'), '/');

        foreach (config('assetv.paths') as $path) {
            $path = trim($path, '/');
            // Construct the iterator
            if (!is_dir($assetsPath . '/' . $path)) {
                continue;
            }

            $it = new \RecursiveDirectoryIterator($assetsPath . '/' . $path);

            // Loop through files
            foreach (new \RecursiveIteratorIterator($it) as $file) {
                //$file = new \SplFileInfo;

                if ($file->isFile())
                {
                    if (in_array($file->getExtension(), config('assetv.types')))
                    {
                        $relativeFilePath = substr($file->getPathname(), strlen($assetsPath) + 1);
                        $this->info($file->getPathname());

                        // File modification time changed
                        if ($this->mtime->file($relativeFilePath) != $file->getMTime())
                        {
                            $this->version->update($relativeFilePath);
                        }

                        // Set file modification time
                        $this->mtime->update($relativeFilePath, $file->getMTime());
                    }
                }
            }
        }

        $this->version->store();
        $this->mtime->store();

        return;
    }
}