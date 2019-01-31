@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Department {{ $department->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/departments') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/departments/' . $department->id . '/edit') }}" title="Edit Department"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/departments', $department->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Department',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $department->id }}</td>
                                    </tr>
                                    <tr><th> Short Code </th><td> {{ $department->short_code }} </td></tr><tr><th> Name </th><td> {{ $department->name }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <table class="table table-responsive">
                    @foreach ($department->courses as $course)
                            {{-- <td>{{ $course->course_code }} --}}
                                {{-- <ul> --}}
                                    @foreach ($course->students as $student)
                                    <tr>
                                        <td>
                                            {{ $student->first_name }}
                                        </td>
                                    </tr>
                                    @endforeach
                                {{-- </ul> --}}
                            {{-- </td> --}}
                    @endforeach

                   {{--  @foreach ($department->courses as $course)
                            @foreach ($course->students as $student)
                        <tr>
                                <td>{{ $student->first_name }}</td>
                        </tr>
                            @endforeach
                    @endforeach --}}
                </table>
            </div>
        </div>
    </div>
@endsection
