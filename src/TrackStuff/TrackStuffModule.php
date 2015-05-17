<?php

namespace TrackStuff;

use Neptune\Service\AbstractModule;
use Neptune\Core\Neptune;
use Neptune\Routing\Router;

/**
 * TrackStuffModule
 *
 * @author Glynn Forrest <me@glynnforrest.com>
 **/
class TrackStuffModule extends AbstractModule
{

    public function routes(Router $router, $prefix, Neptune $neptune)
    {
    }

    public function register(Neptune $neptune)
    {
    }

    public function boot(Neptune $neptune)
    {
    }

    public function getName()
    {
        return 'track-stuff';
    }

}
