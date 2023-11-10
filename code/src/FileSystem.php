<?php

namespace Returnnull;

use DirectoryIterator;

class FileSystem
{
    public function getFilesFromPath($path, $extension = null)
    {
        $dir = new DirectoryIterator($path);
        $classes = [];

        /** @var DirectoryIterator $fileinfo */
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $filename = $fileinfo->getFilename();
                $classes[] = pathinfo($filename, PATHINFO_FILENAME);
            }
        }

        return $classes;
    }
}
