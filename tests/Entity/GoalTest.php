<?php

namespace TrackStuff\Tests\Entity;
use TrackStuff\Entity\Goal;
use TrackStuff\Entity\GoalLog;

/**
 * GoalTest
 *
 * @author Glynn Forrest <me@glynnforrest.com>
 **/
class GoalTest extends \PHPUnit_Framework_TestCase
{
    protected $conn;

    public function setUp()
    {
        $this->conn = $this->getMockBuilder('Doctrine\DBAL\Connection')
                    ->disableOriginalConstructor()
                    ->getMock();
    }

    public function percentageProvider()
    {
        return [
            [0, 0, 100],
            [0, 100, 0],
            [100, 100, 100],
            [100, 20000, 1],
            [20105, 45000, 45],
            [100000, 45000, 100],
        ];
    }

    /**
     * @dataProvider percentageProvider
     */
    public function testGetPercentage($total, $target, $expected)
    {
        $goal = new Goal($this->conn);
        $logs = GoalLog::newCollection();
        $logs[] = new GoalLog($this->conn, ['amount' => $total]);
        $goal->logs = $logs;
        $goal->target = $target;

        $this->assertSame($expected, $goal->percentage);
    }
}
