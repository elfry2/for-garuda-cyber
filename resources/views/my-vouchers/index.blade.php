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
                        <h5 class="card-title">{{ $item->voucher->name }}</h5>
                        <p class="card-text"><small class="text-body-secondary">Valid until {{date_format(date_add(date_create($item->created_at), date_interval_create_from_date_string("3 months")), 'M d')}} </small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
@endsection
