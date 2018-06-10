<div class="form-group">
	{{ Form::label($displayname, null, ['class' => 'control-label']) }}
	<div class="row">
	<div class="form-group mx-auto col-md-2">
		{{ Form::label('Lundi', null, ['class' => 'control-label']) }}
		{{ Form::text($name.'1', $value[1], ['class' => 'form-control'])}}
	</div>
	<div class="form-group mx-auto col-md-2">
		{{ Form::label('Mardi', null, ['class' => 'control-label']) }}
		{{ Form::text($name.'2', $value[2], ['class' => 'form-control'])}}
	</div>
	<div class="form-group mx-auto col-md-2">
		{{ Form::label('Mercredi', null, ['class' => 'control-label']) }}
		{{ Form::text($name.'3', $value[3], ['class' => 'form-control'])}}
	</div>	
</div>
	<div class="row">

	<div class="form-group mx-auto col-md-2">
		{{ Form::label('Jeudi', null, ['class' => 'control-label']) }}
		{{ Form::text($name.'4', $value[4], ['class' => 'form-control'])}}
	</div>
	<div class="form-group mx-auto col-md-2">
		{{ Form::label('Vendredi', null, ['class' => 'control-label']) }}
		{{ Form::text($name.'5', $value[5], ['class' => 'form-control'])}}
	</div>
	<div class="form-group mx-auto col-md-2">
		{{ Form::label('Samedi', null, ['class' => 'control-label']) }}
		{{ Form::text($name.'6', $value[6], ['class' => 'form-control'])}}
	</div>
	<div class="form-group mx-auto col-md-2">
		{{ Form::label('Dimanche', null, ['class' => 'control-label']) }}
		{{ Form::text($name.'7', $value[7], ['class' => 'form-control'])}}
	</div>
	</div>
</div>

@if (isset($helper))
<small class="form-text text-muted">{{ $helper }}</small>
@endif