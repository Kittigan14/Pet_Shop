@extends("layouts.master")
@section('title') PetShop | Pet items @stop
@section('content')

<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

<div class="panel panel-default">

    <h1> Pet Items </h1>

    <div class="panel-body">
        <form action="{{ URL::to('pet/search') }}" method="post" class="d-flex col-md-2">

            {{ csrf_field() }}

            <input class="form-control col-md-6" type="text" name="q" placeholder="Search...">
            <button class="btn btn-primary" type="submit"> Search </button>

            <a href="{{ URL::to('pet/edit') }}" class="btn btn-success pull-right">Add a pet</a>
        </form>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Pic</th>
                <th>Code</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th class="bs-center">Work</th>
            </tr>
        </thead>

        <tbody>
            @foreach($pets as $p)
            <tr>
                <td><img src="{{ asset($p->image_url) }}" width="64px" alt="{{ $p->name }}"></td>
                <td>{{ $p->code }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->category->name }}</td>
                <td class="bs-price">{{ number_format($p->price, 2) }}</td>

                <td class="bs-center">

                    <a href="{{ URL::to('pet/edit/'.$p->id) }}" class="btn btn-info">
                        <i class="fa fa-edit"></i> Edit
                    </a>

                    <a href="#" class="btn btn-danger btn-delete" id-delete="{{ $p->id }}">
                        <i class="fa fa-trash"></i> Delete 
                    </a>

                </td>

            </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th colspan="4"> All </th>
                <th class="bs-price">{{ number_format($pets->sum('price'), 2) }}</th>
            </tr>
        </tfoot>

    </table>

    <div class="panel-footer">
        <span> Showing {{ count($pets) }} items of information </span>
    </div>

    {{ $pets->links('vendor.pagination.custom') }}
</div>

<script>
    $('.btn-delete').on('click', function () {
        if (confirm("Do you want to delete product information?")) {
            var url = "{{ URL::to('pet/remove') }}" +
                '/' + $(this).attr('id-delete');
            window.location.href = url;
        }
    });

</script>

@endsection
