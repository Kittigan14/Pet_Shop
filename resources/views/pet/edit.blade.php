@extends("layouts.master")
@section('title') PetShop | Edit pet data @stop
@section('content')

{!! Form::model($pet, [
'action' => 'App\Http\Controllers\PetController@update',
'method' => 'post',
'enctype' => 'multipart/form-data'
]) !!}

<input type="hidden" name="id" value="{{ $pet->id }}">

<div class="panel panel-default">

    <div class="panel-heading">

        @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif

    </div>

    <table class="table table-bordered d-flex justify-content-center" id="table-update">

        <div class="pic-pets">

            @if($pet->image_url)
                <img src="{{ URL::to($pet->image_url) }}" width="100px">
            @endif

        </div>

        <tr>
            <td>{{ Form::label('code', 'Pet Code', ['class' => 'form-label']) }}</td>
            <td>{{ Form::text('code', $pet->code, ['class' => 'form-control']) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('name', 'Pet Name', ['class' => 'form-label']) }}</td>
            <td>{{ Form::text('name', $pet->name, ['class' => 'form-control']) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('category_id', 'Pet Type', ['class' => 'form-label']) }}</td>
            <td>{{ Form::select('category_id', $categories, Request::old('category_id'), ['class' => 'form-control']) }}
            </td>
        </tr>

        <tr>
            <td>{{ Form::label('price', 'Price', ['class' => 'form-label']) }}</td>
            <td>{{ Form::text('price', $pet->price, ['class' => 'form-control']) }}</td>
        </tr>

        <tr>
            <td>{{ Form::label('image', 'Choose a Pet Picture', ['class' => 'form-label']) }}</td>
            <td>{{ Form::file('image', ['class' => 'form-control']) }}</td>
        </tr>

    </table>

    <div class="d-flex justify-content-center" id="btn-update">
        <button type="reset" class="btn btn-danger">
            <i class="fa fa-times"></i>
            <a href="{{ URL::to('pet') }}"> Cancel </a>
        </button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
    </div>

    {!! Form::close() !!}

    @endsection
