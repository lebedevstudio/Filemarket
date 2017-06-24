<article class="message is-primary">
    <div class="message-header">
        <p>
            Последние изменения
        </p>
    </div>

    <div class="message-body">
        <div class="content">
            @if($approvals->title !== $file->title)
                <strong>Название</strong>
                <p>{{ $approvals->title }}</p>
            @endif

            @if($approvals->overview_short !== $file->overview_short)
                <strong>Краткое описание</strong>
                <p>{{ $approvals->overview_short }}</p>
            @endif

            @if($approvals->overview !== $file->overview)
                <strong>Описание</strong>
                <p>{{ $approvals->overview }}</p>
            @endif

            @if(($uploads = $file->uploads()->notApproved()->get())->count())
                <strong>Файлы</strong>

                @foreach($uploads as $upload)
                        <p>{{ $upload->filename }}</p>
                @endforeach
            @endif
        </div>
    </div>
</article>