@extends('layouts.master')

@section('title', 'Clients')

@section('header_scripts')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#clients').DataTable();
		});
	</script>
@stop

@section('content')
<div class="container-fluid">
	<div class="panel">
		<div class="panel-body">
			<table id="clients" class="table table-striped" style="width:100%">
				<thead>
					<tr>
						<th>SL.</th>
						<th>Name</th>
						<th>Email</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($clients as $index => $client)
					<tr>
						<td>{{ $index+1 }}</td>
						<td>{{ $client->name }}</td>
						<td>{{ $client->email }}</td>
						<td>
							<a href="{{ route('assign.task', ['client_id'=> $client->id ]) }}">
								<button class="btn btn-info button4">Assign Task</button>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection