@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <a href="{{ url('/admin/products/create') }}" class="btn btn-success btn-sm" title="Add New product">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                      {{--   {!! Form::open(['method' => 'GET', 'url' => '/admin/products', 'class' => 'form-inline pull-right', 'role' => 'search'])  !!}
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!} --}}
                        
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table" id="products">
                                 
                                    </table>
                                    {{-- <div class="pagination-wrapper"> {!! $products->appends(['search' => Request::get('search')])->render() !!} </div> --}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $('#products').DataTable(
            {
                ajax: '{{ route('products.list') }}',
                pageLength: 50,
                // scrollX: true,
                columns :[
                    {data: 'name', title: 'Name'},
                    {data: 'description', title: 'Description'},
                    {data: 'section_id', title: 'Section ID'},
                    {data: 'id', title: 'Edit', 'mRender': function(data){
                            return '<a href="products/'+data+'/edit"> <i class="fa fa-edit fa-lg text-muted"></i> </a>'
                        }
                    },
                ]
            }
        );
    </script>
@endsection
