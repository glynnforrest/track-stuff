<?php

namespace TrackStuff\Entity;

use ActiveDoctrine\Entity\Entity;

class GoalLog extends Entity
{
    protected static $table = 'goal_logs';
    protected static $primary_key = 'id';
    protected static $fields = [
        'id',
        'goal_id',
        'date',
        'amount'
    ];
    protected static $relations = [
        'goal' => [
            'belongs_to', 'TrackStuff\Entity\Goal', 'id', 'goal_id'
        ],
    ];
    protected static $types = [
        'date' => 'date'
    ];
}
