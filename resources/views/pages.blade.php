@extends('layout.front')
@section('content')
    <!-- ======= Header ======= -->


    <!-- ======= Hero Section ======= -->
    <section id="hero" class=" h-auto  align-items-center ">
        <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
            <h1 class="text-center">Pages </h1>
            <div class="mt-3">
                <table class="table">
                    <a class="btn btn-sm btn-primary float-end m-2" href="{{ route('create') }}">create new page</a>
                    @if(Session::has('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ Session::get('message') }}
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Page </th>
                            <th scope="col">View</th>
                            <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $data)
                            <tr>
                                <th scope="row">{{ $data->id }}</th>
                                <td> Page {{ $data->id }}</td>
                                <td> <a href="{{ route('editor.view',$data->id) }}" class="btn btn-info btn-sm">Page Preview</a></td>
                                <td><a class="btn btn-sm btn-primary" href="{{ route('editor',$data->id) }}">Edit</a>
                                <a class="btn btn-sm btn-danger" href="{{ route('page.delete',$data->id) }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        
                        <tr>
                    </tbody>
                </table>

            </div>

        </div>
    </section><!-- End Hero -->
@endsection
