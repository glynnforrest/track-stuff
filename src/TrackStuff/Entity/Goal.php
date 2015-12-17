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
        'target',
    ];
    protected static $relations = [
        'logs' => [
            'has_many', 'TrackStuff\Entity\GoalLog', 'goal_id', 'id'
        ],
    ];

    public function __isset($key)
    {
        return true;
    }

    public function setterTitle($title)
    {
        $this->setRaw('slug', StaticStringy::slugify($title));

        return $title;
    }

    public function getterTotal()
    {
        return array_sum($this->logs->getColumn('amount'));
    }

    public function getterPercentage()
    {
        if ((int) $this->target === 0) {
            return 100;
        }

        return $this->total / (int) $this->target;
    }
}
