<?php

namespace ApiSkeletonsTest\Laravel\Doctrine\DataFixtures;

use ApiSkeletons\Laravel\Doctrine\DataFixtures\ServiceProvider;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use LaravelDoctrine\ORM\DoctrineServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            DoctrineServiceProvider::class,
            ServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']['doctrine.managers.default.paths'] = [
            __DIR__ . '/config'
        ];

        $app['config']['doctrine.managers.default.namespaces'] = [
            'ApiSkeletonsTest\Laravel\Doctrine\DataFixtures\Entity',
        ];

        $app['config']['doctrine.managers.default.meta'] = 'xml';

        $app['config']['doctrine-data-fixtures']
            = include(__DIR__ . '/config/doctrine-data-fixtures.php');
    }

    protected function createDatabase(): EntityManager
    {
        $entityManager = app('em');
        $tool = new SchemaTool($entityManager);
        $tool->createSchema($entityManager->getMetadataFactory()->getAllMetadata());

        return $entityManager;
    }
}
