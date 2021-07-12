@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="col">
                    <h2 class="page-title">
                        Edit Phone Type
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">

                <div class="col-12">
                    <div class="card">
                        <form id="form" action="{{ route('phonetype.update', ['phonetype' => $phonetype->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <div class="col-lg-6">
                                        <label class="form-label required">Type Name</label>
                                        <input type="text" class="form-control" name="name" value={{ old('name', $phonetype->name) }}>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                
                                <button type="submit" class="btn btn-primary ms-auto">
                                    
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $("#form").validate({
            rules: {
                name: {
                    required: true,
                },
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.mb-3').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    </script>
@endpush
