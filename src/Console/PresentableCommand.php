<?php

namespace TheHiveTeam\Presentable\Console;

use Illuminate\Console\GeneratorCommand;

class PresentableCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:presenter';

    /**
     * The console command description.
     *
     * @var string|null
     */
    protected $description = 'Create a new presenter class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Presenter';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/custom-presenter.php.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Models\Presenters';
    }
}
