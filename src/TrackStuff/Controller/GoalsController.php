<?php

namespace TrackStuff\Controller;

use Neptune\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TrackStuff\Entity\Goal;
use Symfony\Component\HttpFoundation\JsonResponse;

class GoalsController extends Controller
{
    public function createAction(Request $request)
    {
        $form = $this->form('track-stuff:goal');

        $form->handle($request);

        if ($form->isValid()) {
            $goal = $this->neptune['track-stuff.goal_updater']->createFromForm($form);

            $this->neptune['session']->getFlashBag()->add(
                'success',
                sprintf('Created %s.', $goal->title)
            );

            return $this->redirect('/goals');
        }

        $this->assets()->addCssGroup('track-stuff:main');

        return $this->render('track-stuff:goals/create.html.twig', [
            'form' => $form,
        ]);
    }

    public function addShorthandLogsAction(Request $request)
    {
        $date = new \DateTime();
        $text = $request->request->get('text');

        try {
            $updater = $this->get('track-stuff.goal_updater');
            $logs = $updater->createLogsFromText($text, $date);
            $logs = array_map(function($log) {
                return $log->amount . ' '.$log->goal->slug;
            }, $logs);

            return new JsonResponse([
                'logs' => $logs,
            ]);
        } catch (\Exception $e) {
            $this->get('logger')->error($e);

            return new JsonResponse([
                'message' => 'An error occurred.',
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function listAction(Request $request)
    {
        $goals = $this->neptune['track-stuff.repo.goal']->findAll();

        $this->assets()->addCssGroup('track-stuff:main');

        return $this->render('track-stuff:goals/list.html.twig', [
            'goals' => $goals
        ]);
    }

    public function viewAction(Request $request, $id)
    {
        $this->assets()->addCssGroup('track-stuff:main');
        $this->assets()->addJsGroup('track-stuff:main');

        $goal = $this->neptune['track-stuff.repo.goal']
              ->findOneBy(['id' => $id]);

        $this->assets()->addCssGroup('track-stuff:main');

        return $this->render('track-stuff:goals/view.html.twig', [
            'goal' => $goal
        ]);
    }
}
