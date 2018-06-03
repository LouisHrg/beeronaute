<div class="form-group">
    {{ Form::label($displayname, null, ['class' => 'control-label']) }}
    {{ Form::text($name, $value, array_merge(['class' => 'form-control','placeholder'=>$placeholder], $attributes)) }}
    @if (isset($helper))
    <small class="form-text text-muted">{{ $helper }}</small>
    @endif
</div>