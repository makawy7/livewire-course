<?php

namespace Tests\Feature;

use App\Http\Livewire\MusicSearch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MusicSearchTest extends TestCase
{
    public function test_searches_correctly_if_song_exits()
    {
        Livewire::test(MusicSearch::class)
            ->assertDontSee('John Lennon')
            ->set('search', 'imagine')
            ->assertSee('John Lennon');
    }

    public function test_shows_message_if_no_song_exists()
    {
        Livewire::test(MusicSearch::class)
            ->set('search', 'feFSEFwsfe')
            ->assertSee('No results found');
    }
}
