<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\UsersPagination;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersPaginationTest extends TestCase
{
    use RefreshDatabase;
    public function test_users_pagination_component_exits()
    {
        $this->get('/users')
            ->assertSeeLivewire('users-pagination');
    }
    public function test_active_button_only_shows_active_users()
    {
        $userA = User::create(
            [
                'name' => 'abdallah',
                'email' => 'abdallah@gmail.com',
                'password' => bcrypt('password'),
                'active' => true
            ]
        );

        $userB = User::create(
            [
                'name' => 'sarah',
                'email' => 'sarah@gmail.com',
                'password' => bcrypt('password'),
                'active' => 0
            ]
        );

        Livewire::test(UsersPagination::class)
            ->set('active', true)
            ->assertSee($userA->name)
            ->assertDontSee($userB->name)
            ->set('active', false)
            ->assertSee($userA->name)
            ->assertSee($userB->name);
    }
}
