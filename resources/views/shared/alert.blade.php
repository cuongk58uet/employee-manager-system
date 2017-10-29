<div class="container-fluid">
    @foreach(['primary', 'success', 'danger', 'warning'] as $alert)
        @if (session($alert))
            <div class="alert alert-{{ $alert }} alert-dismissible fade show" role="alert">
                {{ session($alert) }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    @endforeach
</div>
