<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', trans('backend.Name en')) !!}
    {!! Form::text('name', (isset($category) && $category->getTranslation('name','en')) ? $category->getTranslation('name','en') : null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('name', trans('backend.Name ar')) !!}
    {!! Form::text('name_ar',(isset($category) && $category->getTranslation('name','ar')) ? $category->getTranslation('name','ar') : null, ['class' => 'form-control']) !!}
</div>
<h3>{!! Form::label('price_ranges', trans('backend.price_ranges')) !!}</h3>
<p>
    example 1 if you set min_price is 100 and max price is 500 and the range 100 prices will be like this
    (100 , 200 , 300 ,400 )
</p>
<p>
    example 1 if you set min_price is 50 and max price is 400  prices will be like this
    (50 , 100 , 150 ,200,250,300,350,400 )
</p>
<div class="form-group col-sm-6">
     {!! Form::label('min_price', trans('backend.min_price')) !!}

    {!! Form::number('min_price',(isset($category) && $category->prices_range) ?  $category->prices_range->min_price : null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('max_price', trans('backend.max_price')) !!}
    {!! Form::number('max_price',(isset($category) && $category->prices_range) ?  $category->prices_range->max_price : null, ['class' => 'form-control']) !!}
</div>


<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', trans('backend.image')) !!}
    {!! Form::file('image',['class'=>'form-control']) !!}
    @if(isset($category) && $category->image)
    <img src="{{ Storage::url($category->image) }}" class="card-img-top img-responsive" alt="{{ $category->image }}">
    @endif
</div>
<div class="clearfix"></div>

<!-- Parent Field -->
<div class="clearfix"></div>
<div class="col-md-12">
    {!! Form::label('name', trans('backend.Parent Category')) !!}
    <div id="jstree" style="direction: ltr"></div>
    <input type="hidden" name="parent_id" class="parent_id">
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(trans('backend.Save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.categories.index') !!}" class="btn btn-default">@lang('backend.Cancel')</a>
</div>
