<?php
namespace Phong\Entities;

use Phong\State;

class Paddle implements Updatable, Drawable
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
     * @param int $x
     * @param int $y
     */
    public function __construct($x, $y)
    {
        $this->posX = $x;
        $this->posY = $y;
    }

    /**
     * @param State $state
     */
    public function update(State $state)
    {
        // Slowly follow the ball around only if it's heading in our direction
        $ballCoords = $state->getBall()->getCoordinates();

        if ($ballCoords['vx'] < 0 && $this->posX == 0
            || $ballCoords['vx'] > 0 && $this->posX != 0) {
            $delta = ($this->posY + 2) - $ballCoords['y'];
            if ($delta >= 4) {
                $this->posY -= 2;
            } elseif ($delta >= 2) {
                $this->posY--;
            } elseif ($delta <= -4) {
                $this->posY += 2;
            } elseif ($delta <= -2) {
                $this->posY++;
            }
        }
    }

    /**
     * @return array
     */
    public function getCoordinates(): array
    {
        return [
            'x' => $this->posX,
            'y' => $this->posY,
            'w' => 2,
            'h' => 5
        ];
    }

    /**
     * @return string
     */
    public function getDrawingCharacter(): string
    {
        return html_entity_decode('&#x2588;', ENT_NOQUOTES, 'UTF-8');
    }
}
