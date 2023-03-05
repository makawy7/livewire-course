<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use Livewire\Livewire;
use App\Http\Livewire\PostEdit;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditPostTest extends TestCase
{
    use RefreshDatabase;

    private function createPost()
    {
        return Post::create([
            'title' => 'some title',
            'content' => 'some content'
        ]);
    }
    public function test_edit_post_component_exists()
    {
        $post = $this->createPost();
        $this->get(route('post.edit', $post->id))->assertSeeLivewire('post-edit');
    }

    public function test_title_updates_successfully()
    {
        $post = $this->createPost();
        Livewire::test(PostEdit::class, ['post' => $post])
            ->set('title', 'my new title')
            ->call('editPost')
            ->assertSee('my new title')
            ->assertDontSee('some title');
    }
    public function test_content_updates_successfully()
    {
        $post = $this->createPost();
        Livewire::test(PostEdit::class, ['post' => $post])
            ->set('content', 'my new content')
            ->call('editPost')
            ->assertSee('my new content')
            ->assertDontSee('some content');
    }

    public function test_photo_is_being_uploaded_successfully()
    {
        $post = $this->createPost();
        Storage::fake('public');
        $photo = UploadedFile::fake()->image('photo.jpg');
        Livewire::test(PostEdit::class, ['post' => $post])
            ->set('photo', $photo)
            ->call('editPost')
            ->assertSee('Post has been updated successfully');
        $post->refresh();
        $this->assertNotNull($post->photo);
        Storage::disk('public')->assertExists($post->photo);
    }

    public function test_photo_is_being_validated_correctly()
    {
        $post = $this->createPost();
        Storage::fake('public');
        $file = UploadedFile::fake()->create('file.pdf');
        Livewire::test(PostEdit::class, ['post' => $post])
            ->set('photo', $file)
            ->call('editPost')
            ->assertHasErrors(['photo' => 'image'])
            ->assertSee('The photo field must be an image.');
        $post->refresh();
        $this->assertNull($post->photo);
        Storage::disk('public')->assertMissing($post->photo);
    }
}
