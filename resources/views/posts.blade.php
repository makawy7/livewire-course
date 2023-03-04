<x-layout>
    <div class="my-8">
        <h2 class="text-lg font-semibold mt-4">Livewire Blog Posts w/ Comments</h2>

        <ul class="list-disc mt-4">
            @foreach ($posts as $post)
                <li>
                    <a href="{{route('post.show', $post->id)}}" class="text-blue-600">{{ $post->title }}</a>
                    <a href="" class="text-blue-600"> (Edit)</a>
                </li>
            @endforeach
        </ul>
    </div>
</x-layout>
