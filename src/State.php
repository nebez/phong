<?php

namespace Phong;

class State
{
    /**
     * @var int
     */
    const STOPPED = 0;

    /**
     * @var int
     */
    const RUNNING = 1;

    /**
     * @var int
     */
    const PAUSED = 2;

    /**
     * @var int
     */
    private $state;

    /**
     * @var array
     */
    private $entities;

    /**
     * @var int
     */
    private $gameWidth;

    /**
     * @var int
     */
    private $gameHeight;

    /**
     *
     */
    public function __construct()
    {
        $this->state = self::STOPPED;
        $this->entities = [];
    }

    /**
     * @param int $state
     */
    public function set($state)
    {
        $this->state = $state;
    }

    /**
     * @param int $state
     * @return bool
     */
    public function is($state)
    {
        return $this->state === $state;
    }

    /**
     * @param mixed $entity
     */
    public function addEntity($entity)
    {
        if ($entity instanceof Entities\Ball) {
            $this->entities['ball'] = $entity;
        } else {
            $this->entities[] = $entity;
        }
    }

    /**
     * @return array
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * @return Entities\Ball
     */
    public function getBall()
    {
        return $this->entities['ball'];
    }

    /**
     * @param int $width
     * @param int $height
     */
    public function setGameArea($width, $height)
    {
        $this->gameWidth = (int) $width;
        $this->gameHeight = (int) $height;
    }

    /**
     * @return int
     */
    public function getGameWidth()
    {
        return $this->gameWidth;
    }

    /**
     * @return int
     */
    public function getGameHeight()
    {
        return $this->gameHeight;
    }
}
