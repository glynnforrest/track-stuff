<?php

namespace TrackStuff\Goal;

use Doctrine\DBAL\Connection;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use TrackStuff\Entity\Goal;
use TrackStuff\Form\GoalForm;

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
}
