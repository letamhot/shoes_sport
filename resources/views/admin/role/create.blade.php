@extends('admin.layouts')

@section('title', 'Role')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
        <div class="pull-left">
            <h2>Create type</h2>
        </div>
        @include('partials.message')
        <div class="pull-right">
            <a href="{{route('role.index')}}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
<form action="{{route('role.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group{{$errors->has('name')?' has-error':''}}">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="name">
                <span class="text-danger">{{$errors->first('name')}}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group{{$errors->has('description')?' has-error':''}}">
                <strong>Description:</strong>
                <input type="text" name="description" class="form-control" placeholder="description">
                <span class="text-danger">{{$errors->first('description')}}</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button type="submit" class="btn btn-primary">Add New</button>
        </div>
    </div>
</form>
@endsection
