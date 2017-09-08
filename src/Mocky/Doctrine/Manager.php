<?php

namespace LineMob\Core\Mocky\Doctrine;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Manager
{
    /**
     * @var EntityManager
     */
    static private $manager;

    public static function get($isDevMode = true)
    {
        if (self::$manager) {
            return self::$manager;
        }

        $ds = DIRECTORY_SEPARATOR;
        $config = Setup::createAnnotationMetadataConfiguration([__DIR__.$ds.'Model'], $isDevMode);
        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => __DIR__.$ds.'db.sqlite',
        );

        return self::$manager = EntityManager::create($conn, $config);
    }

    /**
     * @param $class
     *
     * @return \Doctrine\ORM\EntityRepository
     */
    public static function getRepository($class)
    {
        return self::get()->getRepository($class);
    }

    public static function persist($entity)
    {
        self::get()->persist($entity);
    }

    public static function flush($entity = null)
    {
        self::get()->flush($entity);
    }
}
