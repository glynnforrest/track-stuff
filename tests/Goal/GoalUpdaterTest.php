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
        $form->setValue('title', 'Lots of sit-ups');
        $form->setValue('target', 10000);
        $goal = $this->updater->createFromForm($form);
        $this->assertInstanceOf('TrackStuff\Entity\Goal', $goal);
        $this->assertSame('Lots of sit-ups', $goal->title);
        $this->assertSame(10000, $goal->target);
    }

    public function textShorthandProvider()
    {
        return [
            ['20 pressups', [
                ['pressups', 20]
            ]],
            ['20 pressups, 40 pressups', [
                ['pressups', 20],
                ['pressups', 40]
            ]],
            ['20 pressups, 40 pressups, 10 situps', [
                ['pressups', 20],
                ['pressups', 40],
                ['situps', 10]
            ]],
        ];
    }

    /**
     * @dataProvider textShorthandProvider
     */
    public function testParseTextShorthand($text, $expected)
    {
        $this->assertSame($expected, $this->updater->parseTextShorthand($text));
    }
}
