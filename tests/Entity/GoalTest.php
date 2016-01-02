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

    public function meanProvider()
    {
        return [
            [[50, 150, 100], 100.0],
            [[1, 2, 3, 4, 5, 6, 7, 8], 4.5],
            //should be rounded to 1 dp
            [[438, 102, 12, 69, 56, 30, 49, 33], 98.6],
            [[], 0],
        ];
    }

    /**
     * @dataProvider meanProvider
     */
    public function testGetMean($amounts, $expected)
    {
        $goal = new Goal($this->conn);
        $logs = GoalLog::newCollection();
        foreach ($amounts as $amount) {
            $logs[] = new GoalLog($this->conn, ['amount' => $amount]);
        }

        $goal->logs = $logs;

        $this->assertSame($expected, $goal->mean);
    }
}
