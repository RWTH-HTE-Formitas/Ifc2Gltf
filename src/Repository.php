<?php

namespace WebIfc;

use Kreait\Firebase\Database;
use WebIfc\Model\Note;
use WebIfc\Model\Project;

final class Repository
{
    /**
     * @var Database
     */
    protected $database;

    /*public function __construct(Database $database)
    {
        $this->database = $database;
    }*/

    public function getProject(string $id): Project
    {
        // todo: implement

        return Project::fromArray([
            'id' => $id,
            'ifcModelUrl' => '',
        ]);
    }

    public function getNote(string $id): Note
    {
        // todo: implement

        return Note::fromArray([
            'id' => $id,
        ]);
    }
}
