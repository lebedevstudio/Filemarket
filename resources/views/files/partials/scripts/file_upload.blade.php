<script>
    const drop = new Dropzone('#file', {
        url: '{{ route('upload.store', $file) }}',
        createImageThumbnails: false,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': window.Laravel.csrfToken
        }
    });
</script>