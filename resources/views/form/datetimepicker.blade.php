 <div class="form-group">
 {{ Form::label($displayname, null, ['class' => 'control-label']) }}
 <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
 	<input name="{{ $name }}"type="text" data-target="#datetimepicker1" data-toggle="datetimepicker" value="{{ $value }}" placeholder="{{ $placeholder }}" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
 	<div class="input-group-append" >
 		<div class="input-group-text"><span class="icon icon-clock"></span></div>
 	</div>
 </div>
</div>