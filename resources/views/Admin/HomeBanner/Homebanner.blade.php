@extends('Admin.layout') @section('page_title', 'Home Banner') @section('homebanner_select', 'active')
@section('container')

    <!-- display msg -->

    @if (session()->has('message'))
        <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
            <span class="badge badge-pill badge-warning">Success</span>
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <h1 class="mb10">Brand</h1>
    <a href="homebanner/manage_homebanner">
        <button type="button" class="btn btn-success">Add Home Banner</button>
    </a>

    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->

            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Home Bannner Image</th>

                            <th>Button Text</th>
                            <th>Button Link</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key=>$data)
                            <tr>
                                <td>{{ $key+1}}</td>

                                <td>
                                    @if ($data->image != '')
                                        <img width="50px" src="{{ asset('storage/media/Home_Banner/' . $data->image) }}" />
                                    @endif
                                </td>
                                <td>{{ $data->btn_txt }}</td>
                                <td>{{ $data->btn_link }}</td>
                                <td>
                                    @if ($data->status == 1)
                                        <a href="{{ url('admin/homebanner/status/0') }}/{{ $data->id }}">
                                            <button type="button" class="btn btn-success">Active</button>
                                        </a>
                                    @elseif($data->status == 0)
                                        <a href="{{ url('admin/homebanner/status/1') }}/{{ $data->id }}">
                                            <button type="button" class="btn btn-danger">Deactive</button>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/homebanner/manage_homebanner/') }}/{{ $data->id }}"> <i
                                            class="fas fa-edit"></i> </a>

                                    &nbsp; &nbsp;
                                    <a href="{{ url('admin/homebanner/delete') }}/{{ $data->id }}"> <i
                                            class="fas fa-trash"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>

@endsection
