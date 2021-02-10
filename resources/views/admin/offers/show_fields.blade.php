<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', __('models/offers.fields.price').':') !!}
    <p>{{ $offer->price }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', __('models/offers.fields.user_id').':') !!}
    <p>{{ $offer->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/offers.fields.created_at').':') !!}
    <p>{{ $offer->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/offers.fields.updated_at').':') !!}
    <p>{{ $offer->updated_at }}</p>
</div>

