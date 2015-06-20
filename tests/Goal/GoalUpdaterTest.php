<?php

namespace TrackStuff\Tests\Goal;

use TrackStuff\Goal\GoalUpdater;
use TrackStuff\Form\GoalForm;

/**
 * GoalUpdaterTest
 *
 * @author Glynn Forrest <me@glynnforrest.com>
 **/
class GoalUpdaterTest extends \PHPUnit_Framework_TestCase
{
    protected $conn;
    protected $dispatcher;
    protected $updater;

    public function setUp()
    {
        $this->conn = $this->getMockBuilder('Doctrine\DBAL\Connection')
                    ->disableOriginalConstructor()
                    ->getMock();
        $this->dispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $this->updater = new GoalUpdater($this->conn, $this->dispatcher);
    }

    public function testCreateFromForm()
    {
        $form = new GoalForm('');
        $form->setValue('title', 'Take over the world');
        $goal = $this->updater->createFromForm($form);
        $this->assertInstanceOf('TrackStuff\Entity\Goal', $goal);
        $this->assertSame('Take over the world', $goal->title);
    }
}
