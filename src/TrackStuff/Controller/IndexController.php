<?php

namespace TrackStuff\Controller;

use Neptune\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    public function indexAction(Request $request)
    {
        $this->assets()->addCssGroup('track-stuff:main');

        return $this->render('track-stuff:index.html.twig');
    }
}
