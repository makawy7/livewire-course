<?php

namespace Tests\Feature;

use App\Http\Livewire\TagsSection;
use App\Models\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class TagsSectionTest extends TestCase
{
    use RefreshDatabase;
    public function test_tags_section_component_exists()
    {
        $this->get('/tags')->assertSeeLivewire('tags-section');
    }

    public function test_tags_initialized_successfully()
    {
        Tag::create(['name' => 'abdallah']);
        Tag::create(['name' => 'ahmed']);

        Livewire::test(TagsSection::class)
            ->assertSee('abdallah')
            ->assertSee('ahmed');
    }
    public function test_tags_are_being_added_successfully()
    {
        Tag::create(['name' => 'abdallah']);
        Tag::create(['name' => 'ahmed']);

        Livewire::test(TagsSection::class)
            ->emit('tagAdded', 'samir');

        $this->assertDatabaseHas('tags', [
            'name' => 'samir',
        ]);
    }
    public function test_tags_are_being_deleted_successfully()
    {
        Tag::create(['name' => 'abdallah']);
        Tag::create(['name' => 'ahmed']);

        Livewire::test(TagsSection::class)
            ->emit('tagRemoved', 'ahmed');

        $this->assertDatabaseMissing('tags', [
            'name' => 'ahmed'
        ]);
        $this->assertDatabaseHas('tags', [
            'name' => 'abdallah'
        ]);
    }
}
