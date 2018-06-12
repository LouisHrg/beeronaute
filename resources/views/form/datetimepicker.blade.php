 <div class="form-group">
 {{ Form::label($displayname, null, ['class' => 'control-label']) }}
 
 <div class="input-group date" id="{{$name}}" data-target-input="nearest">
 	<input name="{{ $name }}"type="text" data-target="#{{$name}}" data-toggle="datetimepicker" value="{{ $value }}" placeholder="{{ $placeholder }}" class="form-control datetimepicker-input" data-target="#{{$name}}"/>
 	<div class="input-group-append" >
 		<div class="input-group-text"><span class="icon icon-clock"></span></div>
 	</div>
 </div>

</div>