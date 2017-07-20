<?php

namespace LineMob\Core\Storage;

class CommandStorage implements CommandStorageInterface
{
    /**
     * @var string
     */
    private $lineUserId;

    /**
     * @var string
     */
    private $lineActivedCmd;

    /**
     * @var array
     */
    private $lineCommandData = [];

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
    public function getLineActivedCmd()
    {
        return $this->lineActivedCmd;
    }

    /**
     * {@inheritdoc}
     */
    public function setLineActivedCmd($lineActivedCmd)
    {
        $this->lineActivedCmd = $lineActivedCmd;
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
