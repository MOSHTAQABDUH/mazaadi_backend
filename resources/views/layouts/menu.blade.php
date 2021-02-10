
@can('view_users')
<li class="nav-item {{ Request::is('admin/users*') ? 'active' : '' }}">
    <a class="waves-effect waves-dark" href="{!! route('admin.users.index') !!}">
        <i class="nav-icon fa fa-user-circle"></i>
        <span class="hide-menu">@lang('backend.Users')</span>
    </a>
</li>
@endcan

@can('view_roles')
{{-- <li class="nav-item {{ Request::is('admin/roles*') ? 'active' : '' }}">
    <a class="waves-effect waves-dark" href="{!! route('admin.roles.index') !!}">
        <i class="nav-icon fa fa-list"></i>
        <span class="hide-menu">@lang('backend.Roles')</span>
    </a>
</li> --}}
@endcan

@can('view_categories')
<li class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
    <a href="{!! route('admin.categories.index') !!}"><i class="fa fa-edit"></i><span>@lang('backend.Categories')</span></a>
</li>
@endcan

@can('view_countries')
<li class="{{ Request::is('admin/countries*') ? 'active' : '' }}">
    <a href="{{ route('admin.countries.index') }}"><i class="fa fa-edit"></i><span>@lang('models/countries.plural')</span></a>
</li>
@endcan
@can('view_cities')
<li class="{{ Request::is('admin/cities*') ? 'active' : '' }}">
    <a href="{{ route('admin.cities.index') }}"><i class="fa fa-edit"></i><span>@lang('models/cities.plural')</span></a>
</li>
@endcan

@can('view_states')
<li class="{{ Request::is('admin/states*') ? 'active' : '' }}">
    <a href="{{ route('admin.states.index') }}"><i class="fa fa-edit"></i><span>@lang('models/states.plural')</span></a>
</li>
@endcan

@can('view_auctions')
<li class="{{ Request::is('admin/auctions*') ? 'active' : '' }}">
    <a href="{{ route('admin.auctions.index') }}"><i class="fa fa-edit"></i><span>@lang('models/auctions.plural')</span></a>
</li>
@endcan



@can('view_offers')
<li class="{{ Request::is('admin/offers*') ? 'active' : '' }}">
    <a href="{{ route('admin.offers.index') }}"><i class="fa fa-edit"></i><span>@lang('models/offers.plural')</span></a>
</li>
@endcan

@can('view_conversations')
<li class="{{ Request::is('admin/conversations*') ? 'active' : '' }}">
    <a href="{{ route('admin.conversations.index') }}"><i class="fa fa-edit"></i><span>@lang('models/conversations.plural')</span></a>
</li>
@endcan

@can('view_messages')
<li class="{{ Request::is('admin/messages*') ? 'active' : '' }}">
    <a href="{{ route('admin.messages.index') }}"><i class="fa fa-edit"></i><span>@lang('models/messages.plural')</span></a>
</li>
@endcan
<li class="nav-item {{ Request::is('admin/settings*') ? 'active' : '' }}">
    <a class="waves-effect waves-dark" href="{!! route('admin.settings.index') !!}">
        <i class="nav-icon fa fa-cog"></i>
        <span class="hide-menu">@lang('models/settings.plural')</span>
    </a>
</li>

