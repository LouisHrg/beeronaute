<div class="form-group">
    {{ Form::label($displayname, null, ['class' => 'control-label']) }}
  	<select {{ ($multiple == true?"mutiple":"") }} name="{{ $name }}" class="custom-select">
  		@foreach($data as $key => $display)
  		<option value="{{ $display['id'] }}" {{ $display['id'] == $value ? 'selected' : '' }}>{{ ucfirst($display['name']) }}</option>  		
  		@endforeach
  	</select>
</div>