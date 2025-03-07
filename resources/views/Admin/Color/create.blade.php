@extends('Admin.layout')
@section('page_title','Manage Color')
@section('container')

     <h1 class="mb10">Manage Color</h1>
     <a href="{{url('admin/color/')}}">
     <button type="button" class="btn btn-success">Back

     </button>
    </a>

    <div class="row m-t-30">
                            <div class="col-lg-12">
    <div class="row">
    <div class="col-lg-12">
        {{session('message')}}
                                <div class="card">

                                    <div class="card-body">
                                        <form action="{{route('color.store')}}" method="post">
                                         @csrf
                                            <div class="row">
                                         <div class="col-12">
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label lg-12">Color</label>
                                                <input  name="color" type="text"  class="form-control cc-name valid" required>

                                                        @error('color')
                                                   <div class="alert alert-danger">
                                                {{$message}}

                                              @enderror
                                            </div>
                                         </div>
                                            &nbsp; &nbsp;
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                  submit
                                                </button>
                                            </div>
                                         </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
</div>
</div>
</div>
@endsection
