@extends('layouts.layout')

@section('content')
	@if ($registration->id)
		{{ Form::model( $registration, array('route' => array('registrations.update', $registration->id), 'method' => 'put', 'validate'=>true))}}
	@else
		{{ Form::model( $registration, array('route' => 'registrations.store', 'validate'=>true))}}
	@endif
		<table>
			<tbody>
				<tr>
					<th>ID</th>
					<td class="id">{{ $registration->id }}</td>
				</tr>
				<tr>
					<th>Name</th>
					<td class="name">
						{{ Form::text('name') }}
						{{ $errors->first('name') }}
					</td>
				</tr>
			</tbody>
		</table>
		{{ Form::submit('Submit') }}

		@if ($registration->id)
			{{ link_to_route('registrations.show','Cancel',$registration->id)}}
		@else
			{{ link_to_route('registrations.index','Cancel') }}
		@endif
	{{ Form::close() }}
@stop
