@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Section {{ $section->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/sections') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/sections/' . $section->id . '/edit') }}" title="Edit Section"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/sections', $section->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Section',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $section->id }}</td>
                                    </tr>
                                    <tr><th> Section Code </th><td> {{ $section->name }} </td></tr><tr><th> Section Description </th><td> {{ $section->description }} </td></tr><tr><th> Location Id </th><td> {{ $section->location_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Section</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
