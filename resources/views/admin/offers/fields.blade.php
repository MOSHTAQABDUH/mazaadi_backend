<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', __('models/offers.fields.price').':') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/offers.fields.user_id').':') !!}
    {!! Form::select('user_id', App\User::pluck('name','id'),old('user_id'), ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.offers.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
