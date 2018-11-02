<?php

namespace WebIfc;

use Slim\Http\Request;
use Slim\Http\Response;

final class Controller
{
    public function ifcToGltf(Request $request, Response $response, array $args)
    {
        $ifcFilePath = $this->retrieveFile($request->getQueryParam('source'));
        $glTfFilePath = $this->getConverter()->convertIfcToGlTF($ifcFilePath);

        return $response
            ->withAddedHeader('Content-Disposition', "attachment; filename=\"model.gltf\"")
            ->withAddedHeader('Content-Length', filesize($glTfFilePath))
            ->withAddedHeader('Content-Type', 'model/gltf+json')
            ->write(file_get_contents($glTfFilePath))
        ;
    }

    /**
     * Retrieves a file from the given location and saves it into a temporary file of which the path is returned.
     *
     * @param string $location
     * @return string
     */
    private function retrieveFile(string $location): string
    {
        $suffix = pathinfo($location, PATHINFO_EXTENSION) ?: '.tmp';
        $targetPath = TemporaryFileFactory::getTemporaryFilePath($suffix);

        if (($readHandle = fopen($location, 'r')) === false)
        {
            throw new \RuntimeException("fopen() failed for {$location}");
        }

        if (!file_put_contents($targetPath, $readHandle))
        {
            throw new \RuntimeException("file_put_contents() failed for {$targetPath}");
        }

        return $targetPath;
    }

    private function getConverter(): Converter
    {
        return new Converter();
    }
}
