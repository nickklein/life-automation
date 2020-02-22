@if( Session::has("success") )
<div class="alert alert-success alert-block" role="alert">
    <button class="close" data-dismiss="alert"></button>
    {{ Session::get("success") }}
</div>
@endif

//Bonus: you can also use this subview for your error, warning, or info messages 
@if( Session::has("error") )
<div class="alert alert-danger alert-block" role="alert">
    <button class="close" data-dismiss="alert"></button>
    {{ Session::get("error") }}
</div>
@endif