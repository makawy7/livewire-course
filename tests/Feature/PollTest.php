<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use Livewire\Livewire;
use App\Http\Livewire\PollExample;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PollTest extends TestCase
{
    use RefreshDatabase;
    public function test_polling_example_component_exists()
    {
        $this->get(route('polling'))->assertSeeLivewire('poll-example');
    }

    public function test_revenue_updates_successfully()
    {
        Order::factory(10)->create();
        Livewire::test(PollExample::class)
            ->assertSet('revenue', 390)
            ->assertSee(390);
    }
}
