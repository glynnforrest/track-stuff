<?php

namespace TrackStuff\Entity;

use ActiveDoctrine\Entity\Entity;
use Stringy\StaticStringy;
use ActiveDoctrine\Entity\Traits\TimestampTrait;

class Goal extends Entity
{
    use TimestampTrait;

    protected static $table = 'goals';
    protected static $primary_key = 'id';
    protected static $fields = [
        'id',
        'title',
        'slug',
        'target',
        'created_at',
        'updated_at',
    ];
    protected static $types = [
        'target' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected static $relations = [
        'logs' => [
            'has_many', 'TrackStuff\Entity\GoalLog', 'goal_id', 'id'
        ],
    ];

    public function getterTotal()
    {
        return array_sum($this->logs->getColumn('amount'));
    }

    /**
     * @return int
     */
    public function getterPercentage()
    {
        if ((int) $this->target === 0 || $this->total > $this->target) {
            return 100;
        }

        return (int) round($this->total / (int) $this->target * 100, 0);
    }

    public function getterRemaining()
    {
        if ($this->total >= $this->target) {
            return 0;
        }

        return $this->target - $this->total;
    }

    /**
     * @return bool
     */
    public function isTargetReached()
    {
        return $this->remaining === 0;
    }

    /**
     * @return bool
     */
    public function isStarted()
    {
        return $this->total > 0;
    }

    /**
     * @return float
     */
    public function getterMean()
    {
        if ($count = count($this->logs) === 0) {
            return 0;
        }

        return round($this->total / count($this->logs), 1);
    }
}
