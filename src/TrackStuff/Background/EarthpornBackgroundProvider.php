<?php

namespace TrackStuff\Background;

/**
 * Fetch nice nature backgrounds from https://reddit.com/r/earthporn
 *
 * @author Glynn Forrest <me@glynnforrest.com>
 **/
class EarthpornBackgroundProvider implements BackgroundProviderInterface
{
    public function getBackgroundUrl()
    {
        //to be replaced by links that periodically refresh
        return 'https://i.imgur.com/jxdxBLj.jpg';
    }
}
