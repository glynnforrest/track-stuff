<?php

namespace TrackStuff\Background;

/**
 * @author Glynn Forrest <me@glynnforrest.com>
 **/
class ArrayBackgroundProvider implements BackgroundProviderInterface
{
    protected $backgroundUrls = [];

    public function __construct(array $backgroundUrls)
    {
        $this->backgroundUrls = $backgroundUrls;
    }

    public function getBackgroundUrl()
    {
        return $this->backgroundUrls[array_rand($this->backgroundUrls)];
    }
}
