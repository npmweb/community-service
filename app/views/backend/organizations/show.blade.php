@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="columns">
            <h1>Organization</h1>
        </div>
    </div>
    <div class="row">
        <div class="columns">

            {{ Form::open(['route'=>['organizations.destroy',$organization->uid],'method'=>'delete']) }}
                <div class="row">
                    <div class="small-4 columns">
                        {{ link_to_route('organizations.index', 'Done', null, ['class'=>'button expand secondary']) }}
                    </div>
                    <div class="small-4 columns">
                        {{ link_to_route('organizations.edit', 'Edit', $organization->uid, ['class'=>'button expand'] ) }}
                    </div>
                    <div class="small-4 columns">
                        {{ Form::submit('Delete', ['onclick'=>'return confirm("Are you sure you want to delete this record?")', 'class'=>'button expand alert']) }}
                    </div>
                </div>
            {{ Form::close() }}

            <div data-abide="data-abide">
                {{ Form::setModel($organization) }}
                {{ Form::readonly('parent_organization') }}
                {{ Form::readonly('permalink') }}
                {{ Form::readonly('name') }}
                {{ Form::readonly('logo') }}
                {{ Form::readonly('url',null,['format'=>'url']) }}
                {{ Form::readonly('address') }}
                {{ Form::readonly('city') }}
                {{ Form::readonly('state') }}
                {{ Form::readonly('postal_code') }}
                {{ Form::readonly('country') }}
                {{ Form::readonly('email',null,['format'=>'email']) }}
            </div>
        </div>
    </div>

@stop
