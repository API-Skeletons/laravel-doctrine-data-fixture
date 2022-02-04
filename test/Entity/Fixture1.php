<?php

namespace ApiSkeletonsTest\Laravel\Doctrine\DataFixtures\Entity;

/**
 * Fixture1
 */
class Fixture1
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $id;


    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Fixture1
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set id.
     *
     * @param int $id
     *
     * @return Fixture1
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
