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
        $router->route('/', 'track-stuff:index', 'index');
        $router->name('track-stuff:goals:list')->route('/goals', 'track-stuff:goals', 'list');
        $router->route('/goals/create', 'track-stuff:goals', 'create');
        $router->name('track-stuff:goals:view')->route('/goals/:slug', 'track-stuff:goals', 'view');
        $router->name('track-stuff:log:add_shorthand')->route('/goal_log/shorthand', 'track-stuff:goals', 'addShorthandLogs');
        $router->name('track-stuff:graph-data')->route('/graph_data/:type/:goal', 'track-stuff:graph', 'getData');
    }

    public function register(Neptune $neptune)
    {
        $neptune['track-stuff.goal_updater'] = function($neptune) {
            return new Goal\GoalUpdater($neptune['db'], $neptune['dispatcher']);
        };

        $neptune['track-stuff.repo.goal'] = function($neptune) {
            return new Repository\GoalRepository($neptune['db']);
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
