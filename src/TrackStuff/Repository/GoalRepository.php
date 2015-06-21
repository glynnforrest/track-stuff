<?php

namespace TrackStuff\Repository;

use ActiveDoctrine\Repository\AbstractRepository;

/**
 * GoalRepository
 *
 * @author Glynn Forrest <me@glynnforrest.com>
 **/
class GoalRepository extends AbstractRepository
{
    protected $entity_class = 'TrackStuff\Entity\Goal';
}
