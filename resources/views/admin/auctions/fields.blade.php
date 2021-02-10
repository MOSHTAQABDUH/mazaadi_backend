<div class="row">
    <div class="row">
    <!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/auctions.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', __('models/auctions.fields.phone').':') !!}
    {!! Form::number('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Lat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lat', __('models/auctions.fields.lat').':') !!}
    {!! Form::text('lat', null, ['class' => 'form-control']) !!}
</div>

<!-- Lng Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lng', __('models/auctions.fields.lng').':') !!}
    {!! Form::text('lng', null, ['class' => 'form-control']) !!}
</div>

<!-- Location Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location_name', __('models/auctions.fields.location_name').':') !!}
    {!! Form::text('location_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Owner Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('owner_name', __('models/auctions.fields.owner_name').':') !!}
    {!! Form::text('owner_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Details Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('details', __('models/auctions.fields.details').':') !!}
    {!! Form::textarea('details', null, ['class' => 'form-control']) !!}
</div>

<!-- Start Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_price', __('models/auctions.fields.start_price').':') !!}
    {!! Form::text('start_price', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', __('models/auctions.fields.category_id').':') !!}
     {!! Form::select('category_id', App\Models\Category::pluck('name','id'),old('category_id'), ['class' => 'form-control']) !!}
</div>
<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/auctions.fields.user_id').':') !!}
     {!! Form::select('user_id', App\User::pluck('name','id'),old('user_id'), ['class' => 'form-control']) !!}
</div>


<!-- city id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_id', __('models/auctions.fields.country_id').':') !!}
     {!! Form::select('country_id', App\Models\Country::pluck('name','id'),old('country_id'), ['class' => 'form-control']) !!}
</div>

<!-- city id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city_id', __('models/auctions.fields.city_id').':') !!}
     {!! Form::select('city_id', App\Models\City::pluck('name','id'),old('city_id'), ['class' => 'form-control']) !!}
</div>

<!-- Primary Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('primary_image', __('models/auctions.fields.primary_image').':') !!}
    {!! Form::file('primary_image',['class'=>'form-control']) !!}
</div>

<!-- Primary Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('images', __('models/auctions.fields.images').':') !!}
    {!! Form::file('images[]',['multiple'=>true,'class'=>'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', __('models/auctions.fields.status').':') !!}
    {!! Form::select('status', ['on' => 'on','off' => 'off','finished' => 'finished','canceled' => 'canceled'], old('status'), ['class' => 'form-control']) !!}
</div>

<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.auctions.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>

</div>
</div>