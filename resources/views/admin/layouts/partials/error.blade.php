@if (session()->has('success') && session()->get('success'))
<div class="alert alert-info">
    {{ session()->get('success') }}
</div>
@endif

@if (session()->has('success') && !session()->get('success'))
<div class="alert alert-danger">
    {{ section()->get('error') }}
</div>
@endif