<?php

namespace TrackStuff\Entity;

use ActiveDoctrine\Entity\Entity;
use Stringy\StaticStringy;

class Goal extends Entity
{
    protected static $table = 'goals';
    protected static $primary_key = 'id';
    protected static $fields = [
        'id',
        'title',
        'slug',
    ];
    protected static $relations = [
        'logs' => [
            'has_many', 'TrackStuff\Entity\GoalLog', 'goal_id', 'id'
        ],
    ];

    public function setterTitle($title)
    {
        $this->setRaw('slug', StaticStringy::slugify($title));

        return $title;
    }

    public function getterTotal()
    {
        return array_sum($this->logs->getColumn('amount'));
    }
}
