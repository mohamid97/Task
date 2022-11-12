@if ($message = \Illuminate\Support\Facades\Session::get('success'))
<div class="container">
    <div class="table"></div>
    <div class="alert alert-success alert-block">
        <strong>{{ $message }}</strong>
    </div>
</div>
@endif
