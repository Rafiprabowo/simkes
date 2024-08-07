<div class="ms-auto text-muted">
    Search:
    <div class="ms-2 d-inline-block">
        <form action="{{ $action }}" method="post" class="d-flex">
            @csrf
            <input name="name" type="text" class="form-control mx-2" placeholder="{{ $placeholder }}">
            <button class="btn btn-primary mx-1" type="submit">{{ $buttonText }}</button>
        </form>
    </div>
</div>
