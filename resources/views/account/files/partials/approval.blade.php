<article class="message is-primary">
    <div class="message-header">
        <p>
            Последние изменения
        </p>
    </div>

    <div class="message-body">
        <div class="content">
            @if($approval->title !== $file->title)
                <strong>Название</strong>
                <p>{{ $approval->title }}</p>
            @endif

            @if($approval->overview_short !== $file->overview_short)
                <strong>Краткое описание</strong>
                <p>{{ $approval->overview_short }}</p>
            @endif

            @if($approval->overview !== $file->overview)
                <strong>Описание</strong>
                <p>{{ $approval->overview }}</p>
            @endif
        </div>
    </div>
</article>