<?php

/**
 * In the default values listed below, ORM fixtures are configured.  You may
 * configure other Doctrine fixture group types:
 *
 * ORMExecutor | PHPCRExecutor | MongoDBExecutor
 * ORMPurger   | PHPCRPurger   | MongoDBPurger
 */

return [
    'default' => [  // Group name
        'objectManager' => 'Doctrine\ORM\EntityManager',
        'executor' => \Doctrine\Common\DataFixtures\Executor\ORMExecutor::class,
        'purger' => \Doctrine\Common\DataFixtures\Purger\ORMPurger::class,
        'fixtures' => [
            // The order of fixtures in this list is not the order in which
            // they will be executed.  See
            // https://github.com/doctrine/data-fixtures#fixture-ordering
            /**
             Fixture1::class,
             Fixture2::class,
             */
        ],
    ],
];
