<?php

namespace Background;

use TrackStuff\Background\ArrayBackgroundProvider;

/**
 * ArrayBackgroundProviderTest
 *
 * @author Glynn Forrest <me@glynnforrest.com>
 **/
class ArrayBackgroundProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $this->assertInstanceOf('TrackStuff\Background\BackgroundProviderInterface', new ArrayBackgroundProvider([]));
    }

    public function testGetBackgroundUrl()
    {
        $urls = ['/assets/bg.jpg', '/assets/bg2.jpg'];
        $provider = new ArrayBackgroundProvider($urls);
        $this->assertTrue(in_array($provider->getBackgroundUrl(), $urls));
    }
}
