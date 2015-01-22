@extends('layouts.layout')

@section('content')

	{{ link_to('/', 'back') }}

	<h2>Registrations</h2>

	{{ link_to_route('registrations.create', 'Create') }}

	<table>
		<thead>
			<th>ID</th>
			<th>Name</th>
		</thead>
		<tbody>
			@foreach($registrations as $reg)
				<tr>
					<td class="id">{{ link_to_route('registrations.show', $reg->id, $reg->id ) }}</td>
					<td class="name">{{ link_to_route('registrations.show', $reg->name, $reg->id ) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
