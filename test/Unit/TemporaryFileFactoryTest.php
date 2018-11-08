<?php

namespace Ifc2Gltf\Test\Unit;

use PHPUnit\Framework\TestCase;
use Ifc2Gltf\TemporaryFileFactory;

final class TemporaryFileFactoryTest extends TestCase
{


    // Test for TemporaryFileFactory
    public function test(){
        $suffix = '.tmp';
        $systemTempDirectory = sys_get_temp_dir();
        $temporaryFileFactory = TemporaryFileFactory::getTemporaryFilePath($suffix);

        // Assert correct suffix on generated path
        static::assertStringEndsWith($suffix, $temporaryFileFactory);

        // Assert correct TEMP folder location in generated path
        static::assertStringStartsWith($systemTempDirectory, $temporaryFileFactory);

        // Assert that TEMP folder exists and is writable
        static::assertDirectoryExists($systemTempDirectory);
        static::assertDirectoryIsWritable($systemTempDirectory);

    

    }




}
