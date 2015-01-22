@extends('layouts.layout')

@section('content')

	{{ link_to('/', 'back') }}

	<h2>Data Loading</h2>

	<dl>
		<dt>Environment</dt>
		<dd>{{ esc_body($environment) }}</dd>

		<dt>myconfig.string</dt>
		<dd>{{ esc_body($myconfigString) }}</dd>
		
		<dt>myconfig.inherited</dt>
		<dd>{{ esc_body($myconfigInherited) }}</dd>
		
		<dt>myconfig.array</dt>
		<dd>{{ esc_body(print_r($myconfigArray,true)) }}</dd>
		
		<dt>reference</dt>
		<dd>{{ esc_body(print_r($reference,true)) }}</dd>
		
		<dt>middleware</dt>
		<dd>{{ esc_body(print_r($middleware,true)) }}</dd>
		
	</dl>

@stop