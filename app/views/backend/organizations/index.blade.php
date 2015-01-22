@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="small-9 columns">
            <h1>Organizations</h1>
        </div>
        <div class="small-3 columns">
            {{ link_to_route('organizations.create', 'Create', null, ['class'=>'button expand']) }}
        </div>
    </div>

    {{ sample_app_helper() }}
    {{ sample_org_helper() }}

    <div class="row">
        <div class="columns">
            <div id="orgs"></div>
        </div>
    </div>
@stop

@section('js')
<script src="{{asset('includes/shared/js/utils.js')}}"></script>
<script src="{{asset('includes/shared/js/models/Organization.js')}}"></script>
<script type="text/javascript">
var app = app || {};
app.baseUrl = {{ esc_js(url()) }};

$(function(){
    app.organizationCollection = new app.OrganizationCollection();
    app.organizationTable = new bbGrid.View({
        css: 'foundation',
        container: $('#orgs'),
        collection: app.organizationCollection,
        autoFetch: true,
        colModel: [
            {
                property: 'uid',
                label: 'UID',
                render: function(model, view) {
                    return '<a href="'+app.baseUrl+'/organizations/'+esc_url(model.get('uid'))+'">'+esc_body(model.get('uid'))+'</a>';
                }
            },
            {
                property: 'name',
                label: 'Name',
                sortOrder: 'asc'
            }
        ],
        events: {}
    });

});
</script>
@stop
