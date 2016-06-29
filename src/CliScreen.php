<?php
namespace Phong;

use Phong\Entities\Drawable;
use \CLI;

class CliScreen implements Screen
{
    /**
     * @var float
     */
    private $lastDraw;

    public function __construct()
    {
        $this->lastDraw = microtime(true);
    }

    /**
     * @return void
     */
    public function clear()
    {
        CLI\Erase::screen();
        CLI\Output::string("FPS: {$this->getFps()}", 1, 4);
    }

    /**
     * @param Drawable $entity
     */
    public function draw(Drawable $entity)
    {
        $c = $entity->getCoordinates();

        // Translate coordinates to \CLI\Graphics format
        $x1 = $c['x'] + 1;
        $y1 = $c['y'] + 1;
        $x2 = $c['x'] + $c['w'];
        $y2 = $c['y'] + $c['h'];
        $dc = $entity->getDrawingCharacter();
        CLI\Graphics::box($x1, $y1, $x2, $y2, [$dc, $dc, $dc, $dc]);

        // Set the cursor to the top left of the window to prevent having
        // a weird cursor flicker follow the last drawn element
        CLI\Cursor::hide();
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return CLI\Misc::rows();
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return CLI\Misc::cols();
    }

    /**
     * @return string
     */
    private function getFps(): string
    {
        $now = microtime(true);
        $duration = $now - $this->lastDraw;
        $this->lastDraw = $now;

        return number_format(1 / $duration, 3);
    }
}
