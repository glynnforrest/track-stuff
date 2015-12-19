<?php

namespace TrackStuff\Form;

use Reform\Form\Form;
use Reform\Form\Renderer\FoundationRenderer;
use Reform\Validation\Rule;

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
        $this->text('title')
            ->addRule(new Rule\Required());
        $this->number('target')
            ->addRule(new Rule\Required());
        $this->text('slug')
            ->setLabel('Shorthand word')
            ->addRule(new Rule\Required('Shorthand word is required.'));
        $this->submit('Save');
        $this->setDefaultRenderer(new FoundationRenderer());
    }
}
