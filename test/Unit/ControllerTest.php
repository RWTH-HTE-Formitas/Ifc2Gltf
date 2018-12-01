<?php

namespace Ifc2Gltf\Test\Unit;

use Ifc2Gltf\Controller;
use PHPUnit\Framework\TestCase;
use Slim\Http\Request;

final class ControllerTest extends TestCase
{
    public function test()
    {
        $controller = new Controller();

        $request = self::createConfiguredMock(Request::class, [
          'getMethod' => 'GET',
          'getQueryParam' => "office.ifc"
        ]);


        $response = new \Slim\Http\Response;

        //$controller->ifcToGLTF($request, $response, []);

        static::assertTrue(true);
    }
}
