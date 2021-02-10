<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/auctions.fields.id').':') !!}
    <p>{{ $auction->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/auctions.fields.name').':') !!}
    <p>{{ $auction->name }}</p>
</div>

<!-- Phone Field -->
<div class="form-group">
    {!! Form::label('phone', __('models/auctions.fields.phone').':') !!}
    <p>{{ $auction->phone }}</p>
</div>

<!-- Lat Field -->
<div class="form-group">
    {!! Form::label('lat', __('models/auctions.fields.lat').':') !!}
    <p>{{ $auction->lat }}</p>
</div>

<!-- Lng Field -->
<div class="form-group">
    {!! Form::label('lng', __('models/auctions.fields.lng').':') !!}
    <p>{{ $auction->lng }}</p>
</div>

<!-- Location Name Field -->
<div class="form-group">
    {!! Form::label('location_name', __('models/auctions.fields.location_name').':') !!}
    <p>{{ $auction->location_name }}</p>
</div>

<!-- Owner Name Field -->
<div class="form-group">
    {!! Form::label('owner_name', __('models/auctions.fields.owner_name').':') !!}
    <p>{{ $auction->owner_name }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/auctions.fields.status').':') !!}
    <p>{{ $auction->status }}</p>
</div>

<!-- Details Field -->
<div class="form-group">
    {!! Form::label('details', __('models/auctions.fields.details').':') !!}
    <p>{{ $auction->details }}</p>
</div>

<!-- Start Price Field -->
<div class="form-group">
    {!! Form::label('start_price', __('models/auctions.fields.start_price').':') !!}
    <p>{{ $auction->start_price }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/auctions.fields.created_at').':') !!}
    <p>{{ $auction->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/auctions.fields.updated_at').':') !!}
    <p>{{ $auction->updated_at }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', __('models/auctions.fields.user_id').':') !!}
    <p>{{ $auction->user_id }}</p>
</div>

<!-- Primary Image Field -->
<div class="form-group">
    {!! Form::label('primary_image', __('models/auctions.fields.primary_image').':') !!}
    <p>{{ $auction->primary_image }}</p>
</div>

