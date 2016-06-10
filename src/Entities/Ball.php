<?php
namespace Phong\Entities;

use Phong\State;

class Ball implements Updatable, Drawable
{
    private $posX;

    private $posY;

    private $velX;

    private $velY;

    public function __construct($x, $y)
    {
        // Our position is actually sub-cursor. This makes moving the ball
        // with different velocities much easier and smoother than moving
        // entire blocks at a time.
        $this->posX = $x * 16;
        $this->posY = $y * 16;
        $this->velX = 60;
        $this->velY = rand(-20, 20);
    }

    public function update(State $state)
    {
        if ($this->getPosX() >= $state->getGameWidth() - 5 || $this->getPosX() <= 4) {
            $this->velX *= -1;
            $this->velY = rand(-20, 20);
        }

        if ($this->getPosY() >= $state->getGameHeight() - 2 || $this->getPosY() <= 2) {
            $this->velY *= -1;
        }

        $this->posX += $this->velX;
        $this->posY += $this->velY;
    }

    public function getCoordinates()
    {
        return [
            'x' => $this->getPosX(),
            'y' => $this->getPosY(),
            'w' => 1,
            'h' => 1,
            'vx' => $this->velX,
            'vy' => $this->velY
        ];
    }

    public function getDrawingCharacter()
    {
        return html_entity_decode('&#x263A;', ENT_NOQUOTES, 'UTF-8');
    }

    private function getPosX()
    {
        return round($this->posX / 16);
    }

    private function getPosY()
    {
        return round($this->posY / 16);
    }
}
