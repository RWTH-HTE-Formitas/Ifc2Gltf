<?php

namespace Ifc2Gltf\Test\Unit;

use Ifc2Gltf\Converter;
use PHPUnit\Framework\TestCase;

final class ConverterTest extends TestCase
{

    public function testIfEndFileExists ()
    {
        $file = (new Converter())->convertIfcToGlTF(__DIR__ . '/../assets/Office_A_20110811.ifc');
        static::assertTrue(file_exists($file));
    }

    public function testEndFileExtension ()
    {
        $file = (new Converter())->convertIfcToGlTF(__DIR__ . '/../assets/Office_A_20110811.ifc');
        $info = pathinfo($file);
        static::assertEquals('gltf', $info['extension']);
    }



    public function testIfColladaFileExists ()
    {
        $file = (new Converter())->convertIfcToCollada(__DIR__ . '/../assets/Office_A_20110811.ifc');
        static::assertTrue(file_exists($file));
    }

    public function testColladaFileExtension ()
    {
        $file = (new Converter())->convertIfcToCollada(__DIR__ . '/../assets/Office_A_20110811.ifc');
        $info = pathinfo($file);
        static::assertEquals('dae', $info['extension']);
    }



    public function testIfGltfFileExists ()
    {
        $file = (new Converter())->convertColladaToGlTF(__DIR__ . '/../assets/Office_A_20110811.ifc');
        static::assertTrue(file_exists($file));
    }

    public function testGltfFileExtension ()
    {
        $file = (new Converter())->convertColladaToGlTF(__DIR__ . '/../assets/Office_A_20110811.ifc');
        $info = pathinfo($file);
        static::assertEquals('gltf', $info['extension']);
    }
}
