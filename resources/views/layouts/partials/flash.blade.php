@if(session()->has('success'))
    <div class="notification is-primary">
        {{ session('success') }}
    </div>
@endif

@if(session()->has('failed'))
    <div class="notification is-danger">
        {{ session('failed') }}
    </div>
@endif
