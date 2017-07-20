<?php

namespace LineMob\Core\Storage;

interface CommandStorageInterface
{
    /**
     * @return string
     */
    public function getLineUserId();

    /**
     * @param string $lineUserId
     */
    public function setLineUserId($lineUserId);

    /**
     * @return string
     */
    public function getLineActivedCmd();

    /**
     * @param string $lineActivedCmd
     */
    public function setLineActivedCmd($lineActivedCmd);

    /**
     * @return array
     */
    public function getLineCommandData();

    /**
     * @param array $lineCommandData
     */
    public function setLineCommandData(array $lineCommandData);
}
