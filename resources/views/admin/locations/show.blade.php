@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Location {{ $location->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/locations') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/locations/' . $location->id . '/edit') }}" title="Edit Location"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/locationss', $location->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Location',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $location->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Name </th><td> {{ $location->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Address </th><td> {{ $location->address }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <table class="table table-responsive">
                <!-- dd($location->sections) -->
                @foreach ($location->sections as $section)
                            {{-- <td>{{ $section->name }} --}}
                                {{-- <ul> --}}
                                    @foreach ($section->products as $product)
                                    <tr>
                                        <td>
                                            {{ $product->name }}
                                        </td>
                                    </tr>
                                    @endforeach
                                {{-- </ul> --}}
                            {{-- </td> --}}
                    @endforeach

                   {{--  @foreach ($location->sections as $section)
                            @foreach ($section->products as $product)
                        <tr>
                                <td>{{ $product->name }}</td>
                        </tr>
                            @endforeach
                    @endforeach --}} 
                </table>
            </div>
        </div>
    </div>
@endsection
