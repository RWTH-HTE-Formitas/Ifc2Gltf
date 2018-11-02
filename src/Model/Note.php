<?php

namespace WebIfc\Model;

final class Note extends AbstractModel
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var float[]
     */
    protected $cameraPosition;

    /**
     * @var float[]
     */
    protected $cameraRotation;

    public function getId(): string
    {
        return $this->id;
    }

    public function getCameraPosition(): array
    {
        return $this->cameraPosition;
    }

    public function getCameraRotation(): array
    {
        return $this->cameraRotation;
    }
}
