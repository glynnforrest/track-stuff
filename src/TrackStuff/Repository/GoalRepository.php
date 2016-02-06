<?php

namespace TrackStuff\Repository;

use ActiveDoctrine\Repository\AbstractRepository;
use TrackStuff\Entity\Goal;
use TrackStuff\Entity\GoalLog;

/**
 * GoalRepository
 *
 * @author Glynn Forrest <me@glynnforrest.com>
 **/
class GoalRepository extends AbstractRepository
{
    protected $entity_class = 'TrackStuff\Entity\Goal';

    public function getMode(Goal $goal)
    {
        $result = $this->conn->createQueryBuilder()
                ->select('amount, COUNT(1) as count')
                ->from(GoalLog::getTable())
                ->where('goal_id = ?')
                ->setParameter(0, $goal->id)
                ->orderBy('count', 'DESC')
                ->groupBy('amount')
                ->setMaxResults(1)
                ->execute()
                ->fetch();

        if (isset($result['amount'])) {
            return $result['amount'];
        }

        return 0;

    }
}
