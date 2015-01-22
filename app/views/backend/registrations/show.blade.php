@extends('layouts.layout')

@section('content')
	{{ link_to_route('registrations.edit', 'Edit', $registration->id ) }}
	{{ link_to_route('registrations.index', 'Done') }}

	{{ Form::open(array('route'=>array('registrations.destroy',$registration->id),'method'=>'delete')) }}
		{{ Form::submit('Delete', array('onclick'=>'return confirm("Are you sure you want to delete this record?")')) }}
	{{ Form::close() }}

	<table>
		<tbody>
			<tr>
				<th>ID</th>
				<td class="id">{{ $registration->id }}</td>
			</tr>
			<tr>
				<th>Name</th>
				<td class="name">{{ $registration->name }}</td>
			</tr>
		</tbody>
	</table>
@stop
