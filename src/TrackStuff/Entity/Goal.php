<?php

namespace TrackStuff\Entity;

use ActiveDoctrine\Entity\Entity;
use Stringy\StaticStringy;

class Goal extends Entity
{
    protected static $table = 'goals';
    protected static $primary_key = 'id';
    protected static $fields = [
        'id',
        'title',
        'slug',
    ];
    protected static $relations = [
    ];

    public function setterTitle($title)
    {
        $this->setRaw('slug', StaticStringy::slugify($title));

        return $title;
    }
}
