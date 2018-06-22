<div class="form-group">
    {{ Form::label($displayname, null, ['class' => 'control-label']) }}
  	<select id="{{ $id }}" {{ ($multiple == true?"multiple":"") }} name="{{ $name }}" class="custom-select">
  		@foreach($data as $key => $display)
  		<option value="{{ $display['id'] }}" {{ $display['id'] == $value ? 'selected' : '' }}>{{ ucfirst($display['name']) }}</option>  		
  		@endforeach
  	</select>
</div>