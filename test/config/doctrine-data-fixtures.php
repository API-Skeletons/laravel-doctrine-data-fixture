<?php

return [
    'test1' => [
        'objectManager' => 'Doctrine\ORM\EntityManager',
        'executor' => \Doctrine\Common\DataFixtures\Executor\ORMExecutor::class,
        'purger' => \Doctrine\Common\DataFixtures\Purger\ORMPurger::class,
        'fixtures' => [
            \ApiSkeletonsTest\Laravel\Doctrine\DataFixtures\Fixtures\Fixture1::class,
            \ApiSkeletonsTest\Laravel\Doctrine\DataFixtures\Fixtures\Fixture2::class,
        ],
    ],
    'test2' => [
        'objectManager' => 'Doctrine\ORM\EntityManager',
        'executor' => \Doctrine\Common\DataFixtures\Executor\ORMExecutor::class,
        'purger' => \Doctrine\Common\DataFixtures\Purger\ORMPurger::class,
        'fixtures' => [
        ],
    ],
];
