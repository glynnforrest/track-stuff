<?php

namespace TrackStuff\Twig\Extension;

use TrackStuff\Background\BackgroundProviderInterface;

/**
 * BackgroundExtension.
 *
 * @author Glynn Forrest <me@glynnforrest.com>
 **/
class BackgroundExtension extends \Twig_Extension
{
    protected $backgroundProvider;

    public function __construct(BackgroundProviderInterface $backgroundProvider)
    {
        $this->backgroundProvider = $backgroundProvider;
    }

    public function getName()
    {
        return 'background';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('background', [$this, 'getBackgroundTag'], ['is_safe' => ['html']]),
        ];
    }

    public function getBackgroundTag()
    {
        $style = <<<EOC
<style>
body {
  background: url("%s") no-repeat center center fixed;
}
</style>
EOC;

        return sprintf($style, $this->backgroundProvider->getBackgroundUrl());
    }
}
