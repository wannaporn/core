<?php

namespace LineMob\Core\Mocky\Doctrine;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Manager
{
    public static function get($isDevMode = true)
    {
        $ds = DIRECTORY_SEPARATOR;
        $config = Setup::createAnnotationMetadataConfiguration([__DIR__.$ds.'Model'], $isDevMode);
        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => __DIR__.$ds.'db.sqlite',
        );

        return EntityManager::create($conn, $config);
    }
}
