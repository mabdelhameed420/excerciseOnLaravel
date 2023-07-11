@extends('layouts.offer_master')

@section('content')
    <div class="header-container">
        <h2 class="text-center">{{ __('messages.All Offers') }}</h2>
    </div>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>##</th>
                    <th>{{ __('messages.Offer Name') }}</th>
                    <th>{{ __('messages.Offer details') }}</th>
                    <th>{{ __('messages.Offer Price') }}</th>
                    <th>{{ __('messages.photo') }}</th>
                    <th>{{ __('messages.operation') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($offers as $offer)
                    <tr>
                        <td>{{ $offer->id }}</td>
                        <td>{{ $offer->name }}</td>
                        <td>{{ $offer->details }}</td>
                        <td>{{ $offer->price }}</td>
                        <td>
                            @if ($offer->photo)
                                <img width="125" height="75" src="{{ asset('images/offers/' . $offer->photo) }}"
                                    alt="Offer Photo">
                            @else
                                <span>No Photo Available</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('offer.edit', $offer->id) }}"
                                class="btn btn-success">{{ __('messages.update') }}</a>
                            <a href="{{ route('offer.delete', $offer->id) }}"
                                class="btn btn-danger">{{ __('messages.delete') }}</a>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
