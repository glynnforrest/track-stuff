<?php

use Neptune\Core\Neptune;
use Neptune\Service;
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

        $neptune->addService(new Service\RoutingService());
        $neptune->addService(new Service\TwigService());
        $neptune->addService(new Service\DatabaseService());
        $neptune->addService(new Service\MonologService());
        $neptune->addService(new Service\FormService());
    }

    public function console(Neptune $neptune)
    {
    }
}
