<?php

namespace WebIfc;

use Kreait\Firebase\Database;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

final class Container extends \Slim\Container
{
    public function __construct(array $values = [])
    {
        parent::__construct($values);

        $this['database'] = function(Container $container) {

            $firebaseConfig = $container->settings['firebase'];

            $serviceAccount = ServiceAccount::fromArray($firebaseConfig['account']);
            $firebase = (new Factory())
                ->withServiceAccount($serviceAccount)
                ->create();

            return $firebase->getDatabase();
        };

        $this['repository'] = function(Container $container) {

            /** @var Database $database */
            /*$database = $container->get('database');

            return new Repository($database);*/

            return new Repository();
        };

        $this['converter'] = function() {

            return new Converter();
        };
    }
}
