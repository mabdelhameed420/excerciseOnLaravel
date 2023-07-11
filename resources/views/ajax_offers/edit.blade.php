@extends('layouts.offer_master')

@section('content')
    <h2>{{ __('messages.Update your offer') }}</h2>
    <form method="POST" id="offerForm" enctype="multipart/form-data">
        @csrf
        <!-- Include this line if you're using Laravel's CSRF protection -->
        <div class="form-group">
            <label for="photo">{{ __('messages.photo') }}:</label>
            <input type="file" value="{{ $offer->photo }}" class="form-control @error('photo') is-invalid @enderror"
                id="photo" name="photo">
            @error('photo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name_en">{{ __('messages.Offer Name en') }}:</label>
            <input type="text" value="{{ $offer->name_en }}" class="form-control @error('name_en') is-invalid @enderror"
                id="name_en" name="name_en" required>
            @error('name_en')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name_ar">{{ __('messages.Offer Name ar') }}:</label>
            <input type="text" value="{{ $offer->name_ar }}" class="form-control @error('name_ar') is-invalid @enderror"
                id="name_ar" name="name_ar" required>
            @error('name_ar')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="details_en">{{ __('messages.Offer details en') }}:</label>
            <textarea class="form-control @error('details_en') is-invalid @enderror" id="details_en" name="details_en" required>{{ $offer->details_en }}</textarea>
            @error('details_en')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="details_ar">{{ __('messages.Offer details ar') }}:</label>
            <textarea class="form-control @error('details_ar') is-invalid @enderror" id="details_ar" name="details_ar" required>{{ $offer->details_ar }}</textarea>
            @error('details_ar')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">{{ __('messages.Offer Price') }}:</label>
            <input type="number" value="{{ $offer->price }}" class="form-control @error('price') is-invalid @enderror"
                id="price" name="price" required>
            @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="alert alert-success" id="success-msg" style="display: none;">offer update successfully</div>
        <button id="updateoffer" class="btn btn-primary">{{ __('messages.Submit update') }}</button>
    </form>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '#updateoffer', function(e) {
            e.preventDefault();

            var formData = new FormData($('#offerForm')[0]);

            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route('ajax.update') }}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    // Handle success response here
                    if (data.stutas == true)
                        $('#success-msg').show();
                    else
                        $('#error-msg').show();
                },
                error: function(reject) {
                    // Handle error response here
                }
            });
        });
    </script>
@endsection
