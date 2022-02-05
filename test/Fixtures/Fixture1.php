<?php

namespace ApiSkeletonsTest\Laravel\Doctrine\DataFixtures\Fixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use ApiSkeletonsTest\Laravel\Doctrine\DataFixtures\Entity\Fixture1 as Fixture1Entity;

class Fixture1 implements
    FixtureInterface
{
    const GUEST_ID = 1;
    const USER_ID = 2;
    const ADMIN_ID = 3;

    const GUEST = 'guest';
    const USER = 'user';
    const ADMIN = 'admin';

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
                ->getRepository(Fixture1Entity::class)
                ->find($row['id']);

            if (! $entity) {
                $entity = new Fixture1Entity();

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
