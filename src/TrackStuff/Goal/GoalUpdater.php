<?php

namespace TrackStuff\Goal;

use Doctrine\DBAL\Connection;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use TrackStuff\Entity\Goal;
use TrackStuff\Form\GoalForm;
use TrackStuff\Entity\GoalLog;

/**
 * GoalUpdater
 *
 * @author Glynn Forrest <me@glynnforrest.com>
 **/
class GoalUpdater
{
    protected $dispatcher;
    protected $connection;

    public function __construct(Connection $connection, EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        $this->connection = $connection;
    }

    public function createFromForm(GoalForm $form)
    {
        $goal = new Goal($this->connection);
        $goal->title = $form->getValue('title');
        $goal->save();

        //send goal created event

        return $goal;
    }

    /**
     * Parse shorthand text syntax into goal slugs and amounts.
     */
    public function parseTextShorthand($text)
    {
        $entries = [];
        $items = explode(',', $text);
        foreach ($items as $item) {
            $pieces = explode(' ', trim($item));
            $entries[] = [
                $pieces[1],
                (int) $pieces[0],
            ];
        }

        return $entries;
    }

    /**
     * Create goal logs using a shorthand text syntax.
     *
     * e.g.
     * 40 pressups
     * 120 pressups, 20 situps, 10 miles
     *
     * @param string $text
     * @param \DateTime $date The date of the goal logs
     */
    public function createLogsFromText($text, \DateTime $date)
    {
        $entries = $this->parseTextShorthand($text);

        $logs = [];

        foreach ($entries as $entry) {
            $goal = Goal::selectOne($this->connection)
                  ->where('slug', $entry[0])
                  ->execute();
            if (!$goal) {
                throw new \Exception(sprintf('No goal found that matches slug "%s"', $entry[0]));
            }

            $log = new GoalLog($this->connection);
            $log->goal = $goal;
            $log->amount = $entry[1];
            $log->date = $date;
            $log->save();
            $logs[] = $log;
        }

        return $logs;
    }
}
