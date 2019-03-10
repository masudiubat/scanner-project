@if(count($errors)>0)
@if($title==='Side Winder - Login')
<div class="alert alert-block alert-danger fade in" style="margin-bottom: 0px;margin-top: 10px;font-size: 12px;">
<button type="button" class="close" data-dismiss="alert">×</button>	
    <strong>Error</strong>
    @foreach($errors->all() as $error)
    {{$error}}
    @endforeach
</div>
@else
<div class="alert alert-block alert-danger fade in" style="margin-bottom: 0px;margin-top: 25px;font-size: 18px;">
<button type="button" class="close" data-dismiss="alert">×</button>	
    <strong>Error</strong>
    @foreach($errors->all() as $error)
    {{$error}}
    @endforeach
</div>
@endif
@endif

@if (session('success'))
<div class="alert alert-block alert-success fade in" style="margin-bottom: 0px;margin-top: 25px;font-size: 18px;">
    <button type="button" class="close" data-dismiss="alert">×</button>	
    {{ session('success') }}
</div>
@endif