@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-6 col-md-offset-3">
                <div class="box box-success">
                    <div class="box-header">Edit Student {{ $student->full_name }}</div>
                    <div class="box-body">
                        <a href="{{ url('/admin/students') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($student, [
                            'method' => 'PATCH',
                            'url' => ['/admin/students', $student->id],
                            'class' => '',
                            'files' => true
                        ]) !!}

                        @include ('admin.students.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
