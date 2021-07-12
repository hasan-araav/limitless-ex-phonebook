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
                        Edit Contact
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
                        <form id="form" action="{{ route('phonebook.update', ['phonebook' => $contact->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <div class="col-lg-6">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control" name="first_name" value={{ old('first_name', $contact->first_name) }}>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" value={{ old('last_name', $contact->last_name) }}>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <label class="form-label required">Phone Number</label>
                                            <input type="text" class="form-control" name="phone_number"
                                                value={{ old('phone_number', $contact->phone_number) }}>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label required">Phone Type</label>
                                            <select class="form-select" name="phone_type">
                                                @foreach ($phone_type as $type)
                                                    <option {{ old('phone_type', $contact->phonetype->id) == $type->id ? 'selected': '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
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
                phone_number: {
                    required: true,
                },
                phone_type: {
                    required: true,
                }
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
