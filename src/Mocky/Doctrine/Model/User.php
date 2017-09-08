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
    const START_STATE = 'started';

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
     * @Column(type="datetime_immutable", nullable=true)
     */
    protected $lineLastLogin;

    /**
     * @Column(type="json_array", nullable=true)
     * @var array
     */
    protected $state = [self::START_STATE => 1];

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getLineLastLogin()
    {
        return $this->lineLastLogin;
    }

    /**
     * @param \DateTimeImmutable $lineLastLogin
     */
    public function setLineLastLogin(\DateTimeImmutable $lineLastLogin = null)
    {
        $this->lineLastLogin = $lineLastLogin;
    }

    /**
     * @return array
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param array $state
     */
    public function setState(array $state)
    {
        $this->state = $state;
    }
}
