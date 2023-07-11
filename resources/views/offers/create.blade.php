@extends('layouts.offer_master')

@section('content')
    <h2>{{ __('messages.Add your offer') }}</h2>
    <form method="POST" action="{{ route('offer.store') }}">
        <!-- Replace "/offers" with the appropriate route for adding offers -->
        @csrf
        <!-- Include this line if you're using Laravel's CSRF protection -->
        <div class="form-group">
            <label for="photo">{{ __('messages.photo') }}:</label>
            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo"
                required>
            @error('photo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name_en">{{ __('messages.Offer Name en') }}:</label>
            <input type="text" value="" class="form-control @error('name_en') is-invalid @enderror" id="name_en"
                name="name_en" required>
            @error('name_en')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name_ar">{{ __('messages.Offer Name ar') }}:</label>
            <input type="text" value="" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar"
                name="name_ar" required>
            @error('name_ar')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="details_en">{{ __('messages.Offer details en') }}:</label>
            <textarea class="form-control @error('details_en') is-invalid @enderror" id="details_en" name="details_en"
                value="details_en" required></textarea>
            @error('details_en')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="details_ar">{{ __('messages.Offer details ar') }}:</label>
            <textarea class="form-control @error('details_ar') is-invalid @enderror" id="details_ar" name="details_ar"
                value="details_ar" required></textarea>
            @error('details_ar')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">{{ __('messages.Offer Price') }}:</label>
            <input type="number" value="" class="form-control @error('price') is-invalid @enderror" id="price"
                name="price" required>
            @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ __('messages.Submit add') }}</button>
    </form>
@endsection
