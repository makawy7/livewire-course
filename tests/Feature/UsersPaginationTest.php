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
        [$userA, $userB] = $this->twoUsersSeed();

        Livewire::test(UsersPagination::class)
            ->set('active', true)
            ->assertSee($userA->name)
            ->assertDontSee($userB->name)
            ->set('active', false)
            ->assertSee($userA->name)
            ->assertSee($userB->name);
    }

    public function test_search_returns_the_correct_results()
    {

        [$userA, $userB] = $this->twoUsersSeed();

        Livewire::test(UsersPagination::class)
            ->set('search', 'abdallah')
            ->assertSee($userA->name)
            ->assertDontSee($userB->name)
            ->set('search', 'sarah')
            ->assertDontSee($userA->name)
            ->assertSee($userB->name);
    }

    public function test_sort_by_name_works_correctly()
    {
        [$userA, $userB, $userC] = $this->sortSeed();

        Livewire::test(UsersPagination::class)
            ->call('sort', 'name')
            ->assertSeeInOrder([$userA->name, $userB->name, $userC->name]);
    }

    public function test_name_sort_is_reversed_when_clicked_twice()
    {
        [$userA, $userB, $userC] = $this->sortSeed();

        Livewire::test(UsersPagination::class)
            ->call('sort', 'name')
            ->call('sort', 'name')
            ->assertSeeInOrder([$userC->name, $userB->name, $userA->name]);
    }

    public function test_sort_by_email_works_correctly()
    {
        [$userA, $userB, $userC] = $this->sortSeed();

        Livewire::test(UsersPagination::class)
            ->call('sort', 'email')
            ->assertSeeInOrder([$userA->email, $userB->email, $userC->email]);
    }

    public function test_email_sort_is_reversed_when_clicked_twice()
    {
        [$userA, $userB, $userC] = $this->sortSeed();

        Livewire::test(UsersPagination::class)
            ->call('sort', 'email')
            ->call('sort', 'email')
            ->assertSeeInOrder([$userC->email, $userB->email, $userA->email]);
    }

    private function sortSeed()
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
                'name' => 'basma',
                'email' => 'basma@gmail.com',
                'password' => bcrypt('password'),
                'active' => 0
            ]
        );
        $userC = User::create(
            [
                'name' => 'khalid',
                'email' => 'khalid@gmail.com',
                'password' => bcrypt('password'),
                'active' => 0
            ]
        );

        return [$userA, $userB, $userC];
    }

    private function twoUsersSeed()
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

        return [$userA, $userB];
    }
}
