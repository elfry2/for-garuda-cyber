@extends('layouts.dashboard')
@section('topnav')
@endsection
@section('bottomnav')
@endsection
@section('content')
<div class="row px-2">
    @if ($primary->count() == 0)
    @include('components.no-data-text')
    @else
    @foreach($primary as $item)
    <div class="col-sm-3">
        <div class="card w-100 overflow-auto" style="height: 40em">
            <img src="https://picsum.photos/200?{{ rand() }}" class="card-img-top">
            <div class="card-body position-relative">
                <h5 class="card-title">{{ $item->name }}</h5>
                <small class="text-secondary">Rp. {{ $item->price }}</small>
                <p class="card-text">{{ $item->description }}</p>
                <form method="post" action="{{ route($resource . '.buy', [Str::singular($resource) => $item]) }}" class="position-absolute" style="bottom: 0px; max-width: 90%">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group mb-3">
                            <input  class="form-control" type="number" placeholder="Quantity" name="quantity" value="1" min="1">
                            <button class="btn btn-success" type="submit">Buy</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
@endsection
