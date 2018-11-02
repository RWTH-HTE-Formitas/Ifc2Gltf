<?php

namespace WebIfc\Model;

final class Project extends AbstractModel
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $ifcModelUrl;

    public function getId(): string
    {
        return $this->id;
    }

    public function getIfcModelUrl(): string
    {
        return $this->ifcModelUrl;
    }
}
