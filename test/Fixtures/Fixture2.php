<?php

namespace ApiSkeletonsTest\Laravel\Doctrine\DataFixtures\Fixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use ApiSkeletonsTest\Laravel\Doctrine\DataFixtures\Entity\Fixture2 as Fixture2Entity;

class Fixture2 implements
    FixtureInterface
{
    const GUEST_ID = 4;
    const USER_ID = 5;
    const ADMIN_ID = 6;

    const GUEST = 'guest2';
    const USER = 'user2';
    const ADMIN = 'admin2';

    public function load(ObjectManager $objectManager)
    {
        $data = [
            [
                'id' => self::GUEST_ID,
                'name' => self::GUEST,
            ],
            [
                'id' => self::USER_ID,
                'name' => self::USER,
            ],
            [
                'id' => self::ADMIN_ID,
                'name' => self::ADMIN,
            ],
        ];

        foreach ($data as $row) {
            $entity = $objectManager
                ->getRepository(Fixture2Entity::class)
                ->find($row['id']);

            if (! $entity) {
                $entity = new Fixture2Entity();

                $entity->setId($row['id']);
                $objectManager->persist($entity);
            }

            $entity
                ->setName($row['name'])
            ;

            $objectManager->flush();
        }
    }
}
