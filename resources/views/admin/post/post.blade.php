@extends('layout.admin')

@section('content')
@push('add-css') 
  @livewireStyles
@endpush
   <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12">
                    @livewire('post')
                </div>
            </div>
        </div>
   </main>

@push('add-js')

         @livewireScripts
@endpush
@endsection