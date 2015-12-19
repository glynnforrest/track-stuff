<?php

namespace TrackStuff\Form;

use Reform\Form\Form;
use Reform\Form\Renderer\FoundationRenderer;

/**
 * GoalForm
 *
 * @author Glynn Forrest <me@glynnforrest.com>
 **/
class GoalForm extends Form
{
    protected function init()
    {
        parent::init();
        $this->text('title');
        $this->number('target');
        $this->submit('Save');
        $this->setDefaultRenderer(new FoundationRenderer());
    }
}
