@extends('layouts.offer_master')

@section('content')
    <h2>{{ __('messages.Add your offer') }}</h2>
    <form method="POST" id="offerForm" action="" enctype="multipart/form-data">
        <!-- Replace "/offers" with the appropriate route for adding offers -->
        @csrf
        <!-- Include this line if you're using Laravel's CSRF protection -->
        <div class="form-group">
            <label for="photo">{{ __('messages.photo') }}:</label>
            <input type="file" class="form-control @error('photo') is-invalid @enderror"
                id="photo" name="photo">
            @error('photo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name_en">{{ __('messages.Offer Name en') }}:</label>
            <input type="text" class="form-control @error('name_en') is-invalid @enderror"
                id="name_en" name="name_en" required>
            @error('name_en')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name_ar">{{ __('messages.Offer Name ar') }}:</label>
            <input type="text" class="form-control @error('name_ar') is-invalid @enderror"
                id="name_ar" name="name_ar" required>
            @error('name_ar')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="details_en">{{ __('messages.Offer details en') }}:</label>
            <textarea class="form-control @error('details_en') is-invalid @enderror" id="details_en" name="details_en" required></textarea>
            @error('details_en')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="details_ar">{{ __('messages.Offer details ar') }}:</label>
            <textarea class="form-control @error('details_ar') is-invalid @enderror" id="details_ar" name="details_ar" required></textarea>
            @error('details_ar')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">{{ __('messages.Offer Price') }}:</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror"
                id="price" name="price" required>
            @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="alert alert-success" id="success-msg" style="display: none;">offer added successfully</div>
        <button id="saveoffer" class="btn btn-primary">{{ __('messages.Submit add') }}</button>
    </form>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '#saveoffer', function(e) {
            e.preventDefault();

            var formData = new FormData($('#offerForm')[0]);

            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route('ajax.store') }}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    // Handle success response here
                    if (data.status === true) {
                        $('#success-msg').show();
                        $('.invalid-feedback').remove();
                        $('.is-invalid').removeClass('is-invalid');
                    } else {
                        $('#success-msg').hide();
                        $('.invalid-feedback').remove();
                        $.each(data.errors, function(key, value) {
                            $("#" + key).addClass('is-invalid');
                            $("#" + key).after('<span class="invalid-feedback" role="alert"><strong>' + value + '</strong></span>');
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response here
                    $('#success-msg').hide();
                    $('.invalid-feedback').remove();
                    $('#error-msg').text('An error occurred. Please try again.').show();
                }
            });
        });
    </script>
@endsection
