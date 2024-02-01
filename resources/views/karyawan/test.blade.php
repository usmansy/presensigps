@extends('layouts.admin.tabler')
@section('content')
    <form id="myForm">
        @csrf
        <ul id="formErrors" class="text-danger"></ul>
        <input type="text" name="name" placeholder="Name" id="nameInput" class="form-control">
        <input type="email" name="email" placeholder="Email" id="emailInput" class="form-control">
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection

@push('myscript')
    <script>
        $(document).ready(function() {
            $('#myForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('submitForm') }}",
                    method: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        // handle success
                        $('#nameInput').removeClass('is-invalid');
                        $('#emailInput').removeClass('is-invalid');
                    },
                    error: function(response) {
                        $('#formErrors').empty();
                        if (response.responseJSON.errors.name) {
                            $('#nameInput').addClass('is-invalid');
                            response.responseJSON.errors.name.forEach(function(error) {
                                $('#formErrors').append('<li>' + error + '</li>');
                            });
                        }
                        if (response.responseJSON.errors.email) {
                            $('#emailInput').addClass('is-invalid');
                            response.responseJSON.errors.email.forEach(function(error) {
                                $('#formErrors').append('<li>' + error + '</li>');
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
