<?php

namespace Phong;

class State
{
    const STOPPED = 0;
    const RUNNING = 1;
    const PAUSED = 2;

    private $state;
    private $entities;
    private $gameWidth;
    private $gameHeight;
    private $ball;

    public function __construct()
    {
        $this->state = self::STOPPED;
        $this->entities = [];
    }

    public function set($state)
    {
        $this->state = $state;
    }

    public function is($state)
    {
        return $this->state === $state;
    }

    public function addEntity($entity)
    {
        if ($entity instanceof Entities\Ball) {
            $this->entities['ball'] = $entity;
        } else {
            $this->entities[] = $entity;
        }
    }

    public function getEntities()
    {
        return $this->entities;
    }

    public function getBall()
    {
        return $this->entities['ball'];
    }

    public function setGameArea($width, $height)
    {
        $this->gameWidth = (int) $width;
        $this->gameHeight = (int) $height;
    }

    public function getGameWidth()
    {
        return $this->gameWidth;
    }

    public function getGameHeight()
    {
        return $this->gameHeight;
    }
}
