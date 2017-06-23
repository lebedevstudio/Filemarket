@component('files.partials.file', compact('file'))
    @slot('links')
        <div class="level">
            <div class="level-left">
                <p class="level-item">
                    {{ $file->isFree() ? 'Бесплатно' : $file->price . '₽' }}
                </p>

                @if(! $file->approved)
                    <p class="level-item">Ожидается одобрение</p>
                @endif

                <p class="level-item">
                    {{ $file->isLive() ? 'Опубликовано' : 'Не опубликовано' }}
                </p>

                <a href="{{ route('account.files.edit', compact('file')) }}" class="level-item">Изменить</a>
            </div>
        </div>
    @endslot
@endcomponent
