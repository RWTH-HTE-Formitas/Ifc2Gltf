<?php

namespace Ifc2Gltf;

final class TemporaryFileFactory
{
    private function __construct() {}

    /**
     * Creates a temporary file with the given suffix and returns its path.
     *
     * @param string $suffix
     * @return string
     */
    public static function getTemporaryFilePath(string $suffix = '.tmp'): string
    {
        do
        {
            $path = sys_get_temp_dir() . '/' . uniqid() . $suffix;
        }
        while(file_exists($path));

        register_shutdown_function(function() use ($path) {

            if (is_file($path))
            {
                unlink($path);
            }
        });

        return $path;
    }
}
