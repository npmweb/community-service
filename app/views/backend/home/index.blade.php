@extends('layouts.layout')

@section('content')

	<h2>Home</h2>

	<ul>
		<li>{{ link_to('dataSources','Data Sources') }}</li>
		<li>{{ link_to('security','Security') }}</li>
		<li>{{ link_to('registrations','CRUD') }}</li>
	</ul>

@stop