<?php

namespace TheHiveTeam\Presentable;

use Illuminate\Support\ServiceProvider;
use TheHiveTeam\Presentable\Console\PresentableCommand;

class PresentableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                PresentableCommand::class,
            ]);
        }
    }
}
