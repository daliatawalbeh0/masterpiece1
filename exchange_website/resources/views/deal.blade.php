{{-- resources/views/confirm_deal.blade.php --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Confirm Deal</h2>
        <form action="{{ route('deal.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="item_id">Choose Your Item</label>
                <select name="item_id" id="item_id" class="form-control">
                    <option value="" selected disabled>Select your item</option>
                    @foreach($userItems as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="offered_item_id">Offered Item ID</label>
                <input type="text" name="offered_item_id" id="offered_item_id" class="form-control" value="{{ $otherUserItem->id }}" readonly>
            </div>

            <div class="form-group">
                <label for="additional_info">Additional Information</label>
                <textarea name="additional_info" id="additional_info" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Deal for Approval</button>
        </form>
    </div>
@endsection
