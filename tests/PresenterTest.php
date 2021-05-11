<?php

namespace TheHiveTeam\Presentable\Tests;

use Illuminate\Database\Eloquent\Model;
use Orchestra\Testbench\TestCase;
use TheHiveTeam\Presentable\HasPresentable;
use TheHiveTeam\Presentable\Presenter;

class PresenterTest extends TestCase
{
    /** @test */
    public function it_presents_title()
    {
        $class = new class extends Model
        {
            use HasPresentable;

            protected $presenter = TestPresenter::class;
        };

        $this->assertEquals('-', $class->present()->title);
    }
}

class TestPresenter extends Presenter
{
    public function title()
    {
        return $this->model->title ?? '-';
    }
}
