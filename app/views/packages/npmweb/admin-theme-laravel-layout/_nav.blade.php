@if( Auth::check() )
    @if( Auth::user()->access(NpmWeb\MultilevelOrganizations\Models\UserType::SITE_ADMIN_LEVEL) )

        <li class="{{{ Request::is( 'organizations') || Request::is( 'organizations/*') ? 'active' : '' }}}">
            <a href="{{ route('organizations.index') }}"><i class="fi-home"></i> Churches</a>
        </li>

        <li class="{{{ Request::is( 'beneficiaries') || Request::is( 'beneficiaries/*') ? 'active' : '' }}}">
            <a href="{{ route('beneficiaries.index') }}" class="{{{ Request::is( 'beneficiaries') ? 'active' : '' }}}"><i class="fi-heart"></i> Beneficiaries</a>
        </li>

    @endif


    @if( Auth::user()->access(NpmWeb\MultilevelOrganizations\Models\UserType::ORG_ADMIN_LEVEL) || Auth::user()->access(NpmWeb\MultilevelOrganizations\Models\UserType::ORG_USER_LEVEL) )
        @if ( $userOrganization )
            <li class="{{{ Request::is( 'organizations/*') ? 'active' : '' }}}">
                <a href="{{ route('organizations.show', $userOrganization->uid) }}"><i class='fi-home'></i> {{ esc_for_body($userOrganization->name) }}</a>
            </li>
        @endif
    @endif

    <li class="{{{ Request::is( 'registrations') ? 'active' : '' }}}">
        <a href="{{ route('registrations.index') }}"><i class='fi-page'></i> Registrations</a>
    </li>

    <li {{ Request::is( 'opportunities/import') ? 'class="active"' : '' }}>
        <a href="{{ route('opportunities.import') }}"><i class='fi-upload'></i> Import</a>
    </li>

    <li class="has-dropdown {{ Request::is( 'reports/*') ? 'active' : '' }}">
        <a href="#"><i class='fi-page-export {{{ Request::is( 'reports/*') ? 'active' : '' }}}'></i> Reports<span class="fa arrow"></span></a>
        <ul class="dropdown">
            <li class="{{{ Request::is( 'reports/registrations/full') ? 'active' : '' }}}">
                <a href="{{ route('reports.registrations.full') }}">Full Export</a>
            </li>
            <li class="{{{ Request::is( 'reports/registrations/weekly') ? 'active' : '' }}}">
                <a href="{{ route('reports.registrations.weekly') }}">Weekly Beneficiary</a>
            </li>
            <li class="{{{ Request::is( 'reports/registrations/sponsorships') ? 'active' : '' }}}">
                <a href="{{ route('reports.registrations.sponsorships') }}">Sponsorships</a>
            </li>
        </ul>
    </li>

    @if( Auth::user()->access(NpmWeb\MultilevelOrganizations\Models\UserType::SITE_ADMIN_LEVEL) )

        <li>
            <a href="{{ route('users.index') }}" class="{{{ Request::is( 'users') || Request::is( 'users/*') ? 'active' : '' }}}"><i class='fi-torsos-all'></i> Users</a>
        </li>

    @endif

    @yield('sidenav')
@endif
