<?php

namespace Ifc2Gltf\Test\Functional;

use Ifc2Gltf\Converter;
use PHPUnit\Framework\TestCase;

final class ObjectIdPersistenceTest extends TestCase
{
    public function test()
    {
        $sourceFile = __DIR__ . '/../assets/Office_A_20110811.ifc';
        $targetFile = (new Converter())->convertIfcToGlTF($sourceFile);

        // extract object ids from target file
        preg_match_all('/"([a-zA-Z0-9_\$]{22})"/', file_get_contents($targetFile), $matches, PREG_PATTERN_ORDER);
        $convertedObjectIds = array_unique($matches[1]);
        sort($convertedObjectIds);

        $originalObjectIds = $this->extractPhysicalObjectIds($sourceFile);

        static::assertEquals($originalObjectIds, array_intersect($originalObjectIds, $convertedObjectIds));
    }

    /**
     * Extracts and returns a list of the ids of all objects within the given ifc file having a physical shape and thus
     * are visible in the 3d model.
     *
     * @param string $sourceFile
     * @return array
     * @throws \Exception
     */
    protected function extractPhysicalObjectIds(string $sourceFile): array
    {
        if (($fp = fopen($sourceFile, 'r')) === false)
        {
            throw new \Exception("fopen() failed for {$sourceFile}");
        }

        $ids = [];
        while($line = fgets($fp))
        {
            if (!preg_match('/^#[0-9]+=([A-Z0-9]+)\(\'([^\']+)\'/', $line, $match))
            {
                continue;
            }

            $entityType = $match[1];
            $objectId = $match[2];

            // http://www.buildingsmart-tech.org/ifc/IFC2x3/TC1/html/ifcsharedbldgelements/ifcsharedbldgelements.htm#entities
            // todo: should IFCSTAIR be in this list?
            if (!in_array($entityType, ['IFCBEAM', 'IFCCOLUMN', 'IFCCURTAINWALL', 'IFCDOOR', 'IFCMEMBER', 'IFCPLATE', 'IFCRAILING', 'IFCRAMP', 'IFCRAMPFLIGHT', 'IFCROOF', 'IFCSLAB', 'IFCSTAIRFLIGHT', 'IFCWALL', 'IFCWALLSTANDARDCASE', 'IFCWINDOW']))
            {
                continue;
            }

            $ids[] = $objectId;
        }
        fclose($fp);

        $ids = array_unique($ids);
        sort($ids);

        return $ids;
    }
}
