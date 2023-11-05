<?php

namespace Returnnull;

class FileSystem
{
    public function getFilesFromPath($path, $extension = null)
    {
        $dir = new \DirectoryIterator($path);
        $classes = [];

        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $filename = $fileinfo->getFilename();
                if ($extension && pathinfo($filename, PATHINFO_EXTENSION) == $extension) {
                    $classes[] = pathinfo($filename, PATHINFO_FILENAME);
                } else {
                    $classes[] = pathinfo($filename, PATHINFO_FILENAME);
                }
            }
        }

        return $classes;
    }
}
