@extends('layouts.master')

@section('title', 'Clients')

@section('content')
<div class="container-fluid">
   <div class="panel panel-default">
      <div class="panel-heading">
         <h3>{{ $program->program_name }}:</h3>
      </div>
      <div class="panel-body">
         <h3 class="sub-header-padding">:: Create Task</h3>

         {{ Form::open(['route'=>['task.table.group.store', $program->id]]) }}
         <div class="field-spacing"">
            <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-globe"></i></span>
               {!! Form::text('task_name', null, ['class'=>'form-control', 'placeholder'=>'Task Name']) !!}
            </div>
         </div>
         <div class="field-spacing"">
            <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-globe"></i></span>
               {!! Form::select('type_id', $task_types->pluck('type', 'id'), null, ['class'=>'form-control']) !!}
            </div>
         </div>
         @if(session()->has('message'))
         <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> {{ session()->get('message') }}
         </div>
         @endif
         {{ Form::submit('Submit', ['class'=>'btn btn-primary btn-block', 'style'=>'margin-top: 30px; border-radius: 20px;']) }}
         {{ Form::close() }}
      </div>
   </div>
   <div class="panel">
      <div class="panel-body">
         <h3 class="sub-header-padding">{{ $program->program_name }} :: Tasks</h3>
         <table class="table table-striped table-bordered">
            <thead>
               <tr>
                  <th>SL.</th>
                  <th>Task Name</th>
                  <th>Task Type</th>
               </tr>
            </thead>
            <tbody>
               @foreach($program_tasks as $index => $program_task)
                  @foreach($program_task->types as $type)
                  <tr>
                     <td>{{ $index + 1 }}</td>
                     <td>{{ $program_task->task_name }}</td>
                     <td>{{ $type->type }}</td>
                  </tr>
                  @endforeach
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>
@endsection