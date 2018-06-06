<div class="form-group">
    {{ Form::label($displayname, null, ['class' => 'control-label']) }}
  	<select name="{{ $name }}" class="custom-select">
  		@foreach($data as $key => $display)
  		<option value="{{ $display['id'] }}">{{ ucfirst($display['name']) }}</option>  		
  		@endforeach
  	</select>
</div>