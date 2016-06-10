<?php
namespace Phong\Entities;

use Phong\State;

class Ball implements Updatable, Drawable
{
    /**
     * @var int
     */
    private $posX;

    /**
     * @var int
     */
    private $posY;

    /**
     * @var int
     */
    private $velX;

    /**
     * @var int
     */
    private $velY;

    /**
     * Ball constructor.
     * @param int $x
     * @param int $y
     */
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

    /**
     * @param State $state
     */
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

    /**
     * @return array
     */
    public function getCoordinates(): array
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

    /**
     * @return string
     */
    public function getDrawingCharacter(): string
    {
        return html_entity_decode('&#x263A;', ENT_NOQUOTES, 'UTF-8');
    }

    /**
     * @return float
     */
    private function getPosX(): float
    {
        return round($this->posX / 16);
    }

    /**
     * @return float
     */
    private function getPosY(): float
    {
        return round($this->posY / 16);
    }
}
