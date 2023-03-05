<?php

namespace Tests\Feature;

use App\Http\Livewire\CommentSection;
use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class CommentSectionTest extends TestCase
{
    use RefreshDatabase;
    private function addPost()
    {
        return Post::create(
            [
                'title' => 'some title',
                'content' => 'some content',
            ]
        );
    }
    public function test_comment_section_component_exists()
    {
        $post = $this->addPost();
        $this->get(route('post.show', $post->id))
            ->assertSeeLivewire('comment-section');
    }

    public function test_comment_added_successfully()
    {
        $post = $this->addPost();
        Livewire::test(CommentSection::class, ['post' => $post])
            ->set('comment', 'hi there!')
            ->call('addComment')
            ->assertSee('hi there!')
            ->assertSee('Comment has been successfully added.');
    }
    public function test_comment_is_required()
    {
        $post = $this->addPost();
        Livewire::test(CommentSection::class, ['post' => $post])
            ->call('addComment')
            ->assertHasErrors(['comment' => 'required'])
            ->assertSee('The comment field is required.');
    }
    public function test_comment_has_min_3_characters()
    {
        $post = $this->addPost();
        Livewire::test(CommentSection::class, ['post' => $post])
            ->set('comment', 'ab')
            ->call('addComment')
            ->assertHasErrors(['comment' => 'min'])
            ->assertSee('The comment field must be at least 3 characters.');
    }
}
