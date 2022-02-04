<?php

namespace ApiSkeletonsTest\Laravel\Doctrine\DataFixtures\Entity;

/**
 * Fixture2
 */
class Fixture2
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
     * @return Fixture2
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
     * @return Fixture2
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
