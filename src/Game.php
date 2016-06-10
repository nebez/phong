<?php
namespace Phong;

class Game
{
    /**
     * @var Screen
     */
    private $output;

    /**
     * @var float
     */
    private $refreshRate;

    /**
     * @var State
     */
    private $state;

    /**
     * Game constructor.
     */
    public function __construct()
    {
        $this->state = new State();
        $this->state->set(State::STOPPED);
    }

    /**
     * @param Screen $output
     */
    public function setOutput(Screen $output)
    {
        $this->output = $output;
        $this->state->setGameArea(
            $this->output->getWidth(),
            $this->output->getHeight()
        );
    }

    /**
     * @param $rate
     */
    public function setRefreshRate($rate)
    {
        // We want the refresh rate to be in microseconds thanks to usleep
        $this->refreshRate = 1000000 / $rate;
    }

    /**
     *
     */
    public function start()
    {
        $this->state->addEntity(
            new Entities\Paddle(0, 0)
        );
        $this->state->addEntity(
            new Entities\Paddle($this->output->getWidth() - 2, 0)
        );
        $this->state->addEntity(
            new Entities\Ball($this->output->getWidth() / 2, $this->output->getHeight() / 2)
        );

        $this->state->set(State::RUNNING);
    }

    /**
     *
     */
    public function pause()
    {
        $this->state->set(State::PAUSED);
    }

    /**
     *
     */
    public function stop()
    {
        $this->state->set(State::STOPPED);
    }

    /**
     * @return bool
     */
    public function isRunning()
    {
        return $this->state->is(State::RUNNING);
    }

    /**
     *
     */
    public function poll()
    {
        $start = microtime(true) * 1000 * 1000;

        $this->output->clear();

        foreach ($this->state->getEntities() as $entity) {
            if ($entity instanceof Entities\Updatable) {
                $entity->update($this->state);
            }

            if ($entity instanceof Entities\Drawable) {
                $this->output->draw($entity);
            }
        }

        $end = microtime(true) * 1000 * 1000;

        // Prevent the game from speeding up if loop executes faster than our
        // maximum allowed refresh rate per second.
        $timeTaken = $end - $start;

        if ($timeTaken < $this->refreshRate) {
            usleep($this->refreshRate - $timeTaken);
        }
    }
}
