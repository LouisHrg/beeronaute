<div class="form-group">
	{{ Form::label($displayname, null, ['class' => 'control-label']) }}
	<div class="input-group">

	<input id="{{$name}}" type="password" class="form-control" name="{{$name}}"  placeholder="{{ $placeholder }}" {{ $required?'required':''}}>
			<div class="input-group-append" >
			<div class="input-group-text"><span class="icon icon-lock"></span></div>
		</div>
	</div>
	@if (isset($helper))
	<small class="form-text text-muted">{{ $helper }}</small>
	@endif
</div>

<div class="form-group">
	{{ Form::label("Confirmation ".strtolower($displayname), null, ['class' => 'control-label']) }}
	<div class="input-group">
		<input id="{{$name}}_confirmation" type="password" class="form-control" name="{{$name}}_confirmation"  placeholder="{{ $placeholder2 }}" {{ $required?'required':''}}>
		<div class="input-group-append" >
			<div class="input-group-text"><span class="icon icon-lock"></span></div>
		</div>
	</div>
	@if (isset($helper))
	<small class="form-text text-muted">{{ $helper }}</small>
	@endif
</div>