<?php

namespace TrackStuff;

use Neptune\Service\AbstractModule;
use Neptune\Core\Neptune;
use Neptune\Routing\Router;
use TrackStuff\Goal\GoalUpdater;

/**
 * TrackStuffModule
 *
 * @author Glynn Forrest <me@glynnforrest.com>
 **/
class TrackStuffModule extends AbstractModule
{
    public function routes(Router $router, $prefix, Neptune $neptune)
    {
        $router->route('/', 'track-stuff:index', 'index');
        $router->route('/goals', 'track-stuff:goals', 'list');
        $router->route('/goals/create', 'track-stuff:goals', 'create');
    }

    public function register(Neptune $neptune)
    {
        $neptune['track-stuff.goal_updater'] = function($neptune) {
            return new GoalUpdater($neptune['db'], $neptune['dispatcher']);
        };
    }

    public function boot(Neptune $neptune)
    {
    }

    public function getName()
    {
        return 'track-stuff';
    }

}
