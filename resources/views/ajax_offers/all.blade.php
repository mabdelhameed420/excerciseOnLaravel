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
                    <tr class="offer{{ $offer->id }}">
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
                            <a href="{{ route('ajax.edit', $offer->id) }}"
                                class="btn btn-success">{{ __('messages.update').' ajax' }}</a>
                            <a href="{{ route('ajax.delete', $offer->id) }}" class="delete-btn btn btn-danger"
                                offer_id="{{ $offer->id }}">{{ __('messages.delete') . ' ajax' }}</a>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var offer_id = $(this).attr('offer_id');
            $.ajax({
                type: 'post',
                url: "{{ route('ajax.delete') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': offer_id,
                },
                success: function(data) {
                    // Handle success response here
                    if (data.stutas == true)
                        $('#success-msg').show();
                    $('.offer'+data.id).remove();
                },
                error: function(reject) {
                    // Handle error response here
                }
            });
        });
    </script>
@endsection
