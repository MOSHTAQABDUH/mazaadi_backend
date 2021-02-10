<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/favorites.fields.id').':') !!}
    <p>{{ $favorite->id }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', __('models/favorites.fields.user_id').':') !!}
    <p>{{ $favorite->user_id }}</p>
</div>

<!-- Auction Id Field -->
<div class="form-group">
    {!! Form::label('auction_id', __('models/favorites.fields.auction_id').':') !!}
    <p>{{ $favorite->auction_id }}</p>
</div>

