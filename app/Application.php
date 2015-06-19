<?php

use Neptune\Core\Neptune;
use Neptune\Service;
use Neptune\Assets\AssetsModule;
use TrackStuff\TrackStuffModule;

/**
 * Application
 *
 * @author Glynn Forrest <me@glynnforrest.com>
 **/
class Application
{
    public function start(Neptune $neptune)
    {
        $neptune->addModule(new TrackStuffModule());
        $neptune->addModule(new AssetsModule(false));

        $neptune->addService(new Service\RoutingService());
        $neptune->addService(new Service\SessionService());
        $neptune->addService(new Service\TwigService());
        $neptune->addService(new Service\DatabaseService());
        $neptune->addService(new Service\MonologService());
        $neptune->addService(new Service\FormService());

        $neptune->extend('twig', function($twig, $neptune) {
            $twig->addGlobal('app', $neptune);

            return $twig;
        });
    }

    public function console(Neptune $neptune)
    {
    }
}
