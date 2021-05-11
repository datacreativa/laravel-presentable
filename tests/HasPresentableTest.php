<?php

namespace TheHiveTeam\Presentable\Tests;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Orchestra\Testbench\TestCase;
use TheHiveTeam\Presentable\HasPresentable;
use TheHiveTeam\Presentable\Presenter;

class HasPresentableTest extends TestCase
{
    /** @test */
    public function it_throws_an_exception_if_the_model_does_not_define_a_presentable_property()
    {
        $model = new class extends Model
        {
            use HasPresentable;
        };

        try {
            $model->present();
        } catch (Exception $exception) {
            $this->assertEquals('Please set the $presenter property to your presenter path.', $exception->getMessage());

            return;
        }

        $this->fail('Did not throw the expected exception');
    }

    /** @test */
    public function it_throws_an_exception_id_the_presenter_class_does_not_exist()
    {
        $model = new class extends Model
        {
            use HasPresentable;

            protected $presenter = 'UnExistentClass';
        };

        try {
            $model->present();
        } catch (Exception $exception) {
            $this->assertEquals('The presenter class [UnExistentClass] does not exists.', $exception->getMessage());

            return;
        }

        $this->fail('Did not throw the expected exception');
    }

    /** @test */
    public function it_throws_an_exception_id_the_presenter_class_does_not_extend_presenter()
    {
        $model = new class extends Model
        {
            use HasPresentable;

            protected $presenter = \stdClass::class;
        };

        try {
            $model->present();
        } catch (Exception $exception) {
            $this->assertEquals(
                'The presenter ['.\stdClass::class.'] must be an instance of ['.Presenter::class.']',
                $exception->getMessage()
            );

            return;
        }

        $this->fail('Did not throw the expected exception');
    }

    /** @test */
    public function it_returns_null_when_attribute_is_not_set()
    {
        $model = new class extends Model
        {
            use HasPresentable;

            protected $presenter = FakePresenter::class;
        };

        $this->assertNull($model->present()->name);
    }

    /** @test */
    public function it_returns_unaltered_attribute_when_presenter_method_does_not_exist()
    {
        $model = new class extends Model
        {
            use HasPresentable;

            protected $attributes = ['email' => 'john@example.com'];
            protected $presenter = FakePresenter::class;
        };

        $this->assertEquals('john@example.com', $model->present()->email);
    }

    /** @test */
    public function it_returns_modified_attribute_when_presenter_method_exists()
    {
        $model = new class extends Model
        {
            use HasPresentable;

            protected $attributes = ['price' => 1000];
            protected $presenter = FakePresenter::class;
        };

        $this->assertEquals('$ 1,000 MXN', $model->present()->price);
    }
}

class FakePresenter extends Presenter
{
    public function price()
    {
        $price = number_format($this->model->price);

        return "$ {$price} MXN";
    }
}