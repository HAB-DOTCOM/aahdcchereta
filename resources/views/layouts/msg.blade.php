@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger">
    <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none'">×</button>
    <span>
        <b> ስህተት - </b>
        {{ $error }}</span>
</div>
@endforeach
@endif

@if(session('success'))
<div class="alert alert-success">
    <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none'">×</button>
    <span>
        <b> ተሳክቷል - </b> {{ session('success') }}</span>
</div>
@endif
@if(session('infoMsg'))
<div class="alert alert-warning">
    <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none'">×</button>
    <span>
        <b> መረጃ - </b> {{ session('infoMsg') }}</span>
</div>
@endif