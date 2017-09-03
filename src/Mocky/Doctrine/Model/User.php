<?php

namespace LineMob\Core\Mocky\Doctrine\Model;

use LineMob\Core\Storage\CommandDataInterface;

/**
 * @Entity
 * @Table(name="user")
 */
class User implements CommandDataInterface
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(type="string", nullable=true)
     */
    private $lineUserId;

    /**
     * @Column(type="string", nullable=true)
     */
    private $lineActiveCmd;

    /**
     * @Column(type="array", nullable=true)
     */
    private $lineCommandData;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getLineUserId()
    {
        return $this->lineUserId;
    }

    /**
     * {@inheritdoc}
     */
    public function setLineUserId($lineUserId)
    {
        $this->lineUserId = $lineUserId;
    }

    /**
     * {@inheritdoc}
     */
    public function getLineActiveCmd()
    {
        return $this->lineActiveCmd;
    }

    /**
     * {@inheritdoc}
     */
    public function setLineActiveCmd($lineActiveCmd)
    {
        $this->lineActiveCmd = $lineActiveCmd;
    }

    /**
     * {@inheritdoc}
     */
    public function getLineCommandData()
    {
        return $this->lineCommandData;
    }

    /**
     * {@inheritdoc}
     */
    public function setLineCommandData(array $lineCommandData)
    {
        $this->lineCommandData = $lineCommandData;
    }
}
