<?php

namespace Ifc2Gltf;

use Symfony\Component\Process\Process;

/**
 * Provides a simple interface for the actual conversion to convert between different formats based on given model file
 * paths.
 */
final class Converter
{
    /**
     * Converts the ifc file under the given path into a glTF file and returns its path.
     * The resulting file is temporary and removed on the end of the request.
     *
     * @param string $ifcFilePath
     * @return string
     */
    public function convertIfcToGlTF(string $ifcFilePath): string
    {
        exec("java -jar ifcEntityFilter.jar $ifcFilePath");
        $filteredIfcFilePath = substr($ifcFilePath, 0, -4) . '_filtered_.ifc';
        $colladaFilePath = $this->convertIfcToCollada($filteredIfcFilePath);
        $glTfFilePath = $this->convertColladaToGlTF($colladaFilePath);

        return $glTfFilePath;
    }

    /**
     * Converts the ifc file under the given path into a COLLADA file and returns its path.
     * The resulting file is temporary and removed on the end of the request.
     *
     * @param string $ifcFilePath
     * @return string
     */
    public function convertIfcToCollada(string $ifcFilePath): string
    {
        $targetFilePath = TemporaryFileFactory::getTemporaryFilePath('.dae');
        (new Process(['IfcConvert', '--use-element-guids', $ifcFilePath, $targetFilePath]))->setTimeout(null)->mustRun();

        return $targetFilePath;
    }

    /**
     * Converts the COLLADA file under the given path into a glTF file and returns its path.
     * The resulting file is temporary and removed on the end of the request.
     *
     * @param string $ifcFilePath
     * @return string
     */
    public function convertColladaToGlTF(string $colladaFilePath): string
    {
        $targetFilePath = TemporaryFileFactory::getTemporaryFilePath('.glb');
        (new Process(['COLLADA2GLTF-bin', $colladaFilePath, $targetFilePath, '-b']))->setTimeout(null)->mustRun();

        return $targetFilePath;
    }
}
