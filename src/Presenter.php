<?php

namespace TheHiveTeam\Presentable;

abstract class Presenter
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    /**
     * Allow for property-style retrieval.
     *
     * @param  mixed  $property
     * @return mixed
     */
    public function __get($property)
    {
        if (method_exists($this, $property)) {
            return $this->$property();
        }

        return $this->model->$property;
    }

    /**
     * Provide compatibility for the 'or' syntax in blade templates.
     *
     * @param  mixed  $property
     * @return bool
     */
    public function __isset($property): bool
    {
        return method_exists($this, $property);
    }
}
