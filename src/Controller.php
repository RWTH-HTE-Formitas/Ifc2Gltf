<?php

namespace WebIfc;

use Slim\Http\Request;
use Slim\Http\Response;

final class Controller
{
    /**
     * @var Container
     */
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function noteScene(Request $request, Response $response, array $args)
    {
        $repository = $this->getRepository();
        $project = $repository->getProject($args['projectId']);

        $ifcFilePath = $this->retrieveFile($project->getIfcModelUrl());
        $glTfFilePath = $this->getConverter()->convertIfcToGlTF($ifcFilePath);

        return $response
            ->withAddedHeader('Content-Disposition', "attachment; filename=\"scene-{$project->getId()}.gltf\"")
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
        return $this->container->get('converter');
    }

    private function getRepository(): Repository
    {
        return $this->container->get('repository');
    }
}
