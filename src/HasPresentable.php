<?php

namespace TheHiveTeam\Presentable;

use Exception;
use Illuminate\Container\Container;

trait HasPresentable
{
    /**
     * View presenter instance.
     *
     * @var mixed
     */
    protected $presenterInstance;

    /**
     * Prepare a new or cached presenter instance.
     *
     * @return mixed
     * @throws \Exception
     */
    public function present()
    {
        if (! $this->presenter) {
            throw new Exception('Please set the $presenter property to your presenter path.');
        }

        if (! class_exists($this->presenter)) {
            throw new Exception("The presenter class [{$this->presenter}] does not exists.");
        }

        if (! $this->presenterInstance) {
            $this->presenterInstance = Container::getInstance()->make($this->presenter);

            if (! $this->presenterInstance instanceof Presenter) {
                throw new Exception("The presenter [{$this->presenter}] must be an instance of [".Presenter::class.']');
            }

            $this->presenterInstance->setModel($this);
        }

        return $this->presenterInstance;
    }
}