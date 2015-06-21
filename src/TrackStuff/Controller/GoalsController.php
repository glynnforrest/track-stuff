<?php

namespace TrackStuff\Controller;

use Neptune\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TrackStuff\Entity\Goal;

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

    public function listAction(Request $request)
    {
        $goals = Goal::select($this->neptune['db'])->execute();

        $this->assets()->addCssGroup('track-stuff:main');

        return $this->render('track-stuff:goals/list.html.twig', [
            'goals' => $goals
        ]);
    }

    public function viewAction(Request $request, $id)
    {
        $goal = $this->neptune['track-stuff.repo.goal']
              ->findOneBy(['id' => $id]);

        $this->assets()->addCssGroup('track-stuff:main');

        return $this->render('track-stuff:goals/view.html.twig', [
            'goal' => $goal
        ]);
    }
}
