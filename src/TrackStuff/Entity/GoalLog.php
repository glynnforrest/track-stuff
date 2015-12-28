<?php

namespace TrackStuff\Entity;

use ActiveDoctrine\Entity\Entity;
use ActiveDoctrine\Entity\Traits\TimestampTrait;

class GoalLog extends Entity
{
    use TimestampTrait;

    protected static $table = 'goal_logs';
    protected static $primary_key = 'id';
    protected static $fields = [
        'id',
        'goal_id',
        'date',
        'amount',
        'created_at',
        'updated_at',
    ];
    protected static $relations = [
        'goal' => [
            'belongs_to', 'TrackStuff\Entity\Goal', 'id', 'goal_id'
        ],
    ];
    protected static $types = [
        'id' => 'integer',
        'date' => 'date',
        'amount' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
