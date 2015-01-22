@extends('layouts.layout')

@section('content')
	<div class="row">
		<div class="columns">
			<h2>Organizations</h2>
			<ul>
				@foreach( $organizations as $org )
					<li>{{ esc_body($org->name) }}</li>
				@endforeach
			</ul>
		</div>
        <div class="columns">
            <h2>Churches (from reference data)</h2>
            <ul>
                @foreach( $churches as $church => $churchLabel )
                <li>{{ esc_body($church) }}</li>
                @endforeach
            </ul>
        </div>
	</div>
@stop
