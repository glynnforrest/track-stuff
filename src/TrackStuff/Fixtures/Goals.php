<?php

namespace TrackStuff\Fixtures;

use Doctrine\DBAL\Connection;
use ActiveDoctrine\Fixture\FixtureInterface;
use TrackStuff\Entity\Goal;
use TrackStuff\Entity\GoalLog;

class Goals implements FixtureInterface
{
    public function load(Connection $connection)
    {
        $things = [
            'pressups',
            'situps',
            'miles',
            'laps',
        ];

        foreach ($things as $thing) {
            $goal = new Goal($connection);
            $target = floor(rand(10000, 100000) / 1000) * 1000;
            $goal->setValues([
                'title' => $target.' '.$thing,
                'slug' => $thing,
                'target' => $target,
            ]);
            $goal->save();

            //25% chance of 0 logs, otherwise even spread
            $amount = rand(0, 3) === 1 ? 0 : rand(1, 365);

            $date = new \DateTime();
            for ($j = 0; $j < $amount; $j++) {
                $log = new GoalLog($connection);
                $log->setValues([
                    'goal' => $goal,
                    'amount' => floor(rand(10, 300) / 5) * 5,
                    'date' => $date->modify('-1 day'),
                ]);
                $log->save();
            }
        }
    }

    public function getTables()
    {
        return [
            Goal::getTable(),
            GoalLog::getTable(),
        ];
    }
}
