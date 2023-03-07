<div class="mt-4">
    <div wire:ignore class="w-1/2 border px-4 py-2" x-data x-init="new Taggle($el, {
        tags: {{ $tags }},
        onTagAdd: function(event, tag) {
            Livewire.emit('tagAdded', tag)
        },
        onTagRemove: function(event, tag) {
            Livewire.emit('tagRemoved', tag)
        }
    });
    Livewire.on('added', tag => {
        console.log('tag has been added: ' + tag);
    })">

    </div>
</div>
