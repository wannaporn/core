<?php

namespace LineMob\Core\Mocky\Doctrine\Model;

use LineMob\Core\Storage\CommandData;
use LineMob\Core\Storage\CommandDataInterface;

/**
 * @Entity
 * @Table(name="user")
 */
class User extends CommandData implements CommandDataInterface
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    protected $id;

    /**
     * @Column(type="string", nullable=true)
     */
    protected $lineUserId;

    /**
     * @Column(type="string", nullable=true)
     */
    protected $lineActiveCmd;

    /**
     * @Column(type="array", nullable=true)
     */
    protected $lineCommandData;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
