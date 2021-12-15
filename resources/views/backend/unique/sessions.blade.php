@if (Session::has('k'))
    <div class="alert alert-success">
        <strong>nicew!</strong> {{ Session::get('k') }}
    </div>
@elseif(Session::has('err'))
    <div class="alert alert-danger">
        <strong>Danger!</strong> {{ Session::get('err') }}
    </div>
@endif
