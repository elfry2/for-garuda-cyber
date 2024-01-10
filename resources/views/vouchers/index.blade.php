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
    <div class="col-sm-6">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="https://picsum.photos/200?{{ rand() }}" class="img-fluid rounded-start">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text"><small class="text-body-secondary">Get one per Rp. {{ $item->price }} spent on tenants.</small></p>
                        <a class="btn btn-success" href="{{ route("$resource.uploadInvoice", [Str::singular($resource) => $item]) }}">Redeem</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
@endsection
