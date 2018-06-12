<div class="form-group">
 {{ Form::label($displayname, null, ['class' => 'control-label']) }}
    {{ Form::number($name,$value,['class'=>'form-control']) }}
    @if (isset($helper))
    <small class="form-text text-muted">{{ $helper }}</small>
    @endif
</div>