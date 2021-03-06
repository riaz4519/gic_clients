@extends('layouts.master')

@section('title', 'Clients')

@section('content')
<div class="container-fluid">
		@if(session()->has('message'))
			<div class="alert alert-success alert-dismissible">
					{{ session()->get('message') }}
			</div>
		@endif
		
		<div class="panel-body">
			<div class="profile-header">
               <div class="overlay"></div>
               <div class="profile-main">
                  <img src="{{ asset('img/blank-dp.png') }}" class="img-circle" alt="Avatar" height="100">
                  <h3 class="name">{{ $client->name}}</h3>
               </div>
               
            </div>
		</div>
	</div>

	<div class="panel">
		<div class="panel-body">
			<h3>:: Assign Tasks</h3>

			<table class="table table-striped">
				<thead>
					<tr>
						<th>Select</th>
						<th>Task Names</th>
						<th>Task Type</th>
						<th>Set Date</th>
						<th>Assign To</th>
					</tr>
				</thead>
				<tbody>
					{{ Form::open(['route' => ['store.client.task', $program_id, $client->id]]) }}
						@foreach($tasks as $task)
							<tr>
								<th>
									{{ Form::checkbox('task_array[]', $task->id, in_array($task->id, $client_task_array) ? 'true' : '') }}
								</th>
								<th>{{ $task->task_name }}</th>
								<th>{{ $task->task_type }}</th>

								@if($task->task_type == 'Task with deadline')
								<th>
									{!! Form::date('date' . $task->id, (isset($client_task_date_array[$task->id])) ? Carbon\Carbon::parse($client_task_date_array[$task->id])->format('Y-m-d') : null, ['class'=>'form-control']) !!}
								</th>
								@else
								<th></th>
								@endif
								<th>
									{{ Form::select($task->id, $rms, (isset($client_task_rm_array[$task->id])) ? $client_task_rm_array[$task->id] : 0, ['class'=>'form-control']) }}
								</th>
							</tr>							
						@endforeach
						<tr>
							<td colspan="5">
								{{ Form::submit('Submit', ['class'=>'btn btn-info btn-block button4', 'style'=>'margin-top: 20px']) }}
							</td>
						</tr>
					{{ Form::close() }}
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection