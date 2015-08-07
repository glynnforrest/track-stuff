<?php

namespace TrackStuff\Controller;

use Neptune\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use TrackStuff\Entity\Goal;

class IndexController extends Controller
{
    public function indexAction(Request $request)
    {
        $this->assets()->addCssGroup('track-stuff:main');
        $this->assets()->addJsGroup('track-stuff:main');

        return $this->render('track-stuff:index.html.twig', [
            'goals' => Goal::select($this->get('db'))->execute(),
        ]);
    }
}
