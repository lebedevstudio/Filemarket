<script>
    const drop = new Dropzone('#file', {
        url: '{{ route('upload.store', $file) }}',
        createImageThumbnails: false,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': window.Laravel.csrfToken
        }
    });

    @foreach($file->uploads as $upload)
        drop.emit('addedfile', {
            id: '{{ $upload->id }}',
            name: '{{ $upload->filename }}',
            size: '{{ $upload->file_size }}'
        });
    @endforeach

    drop.on('success', function (file, response) {
        file.id = response.id;
    });

    drop.on('removedfile', function (file) {
        axios.delete('/{{ $file->identifier }}/upload/' + file.id)
            .catch(function (error) {
               drop.emit('addedfile', {
                   id: file.id,
                   name: file.name,
                   size: file.size
               })
            });
    });
</script>