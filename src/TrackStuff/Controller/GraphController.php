<?php

namespace TrackStuff\Controller;

use Neptune\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TrackStuff\Entity\Goal;
use Symfony\Component\HttpFoundation\JsonResponse;

class GraphController extends Controller
{
    public function getDataAction(Request $request, $type, $goal_id)
    {
        $goal = Goal::selectOne($this->get('db'))->where('id', $goal_id)->execute();

        $data = [];

        foreach ($goal->logs as $log) {
            $date = $log->date->format('Y-m-d');

            $data[$date] = isset($data[$date]) ? $data[$date] + $log->amount : $log->amount;
        }

        ksort($data);
        $response_data = [];
        $total = 0;
        foreach ($data as $date => $amount) {
            $total += $amount;
            $response_data[] = [
                'date' => $date,
                'total' => $total,
            ];
        }

        return new JsonResponse($response_data);
    }
}
