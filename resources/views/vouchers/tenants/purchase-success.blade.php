@extends('layouts.form')
@section('content')
    <h5 class="mt-5">Purchase success!</h5>
    <p>Click <a target="_blank" href="{{ route("$resource.downloadInvoice", ['uuid' => $uuid]) }}">here</a> to download your invoice. Invoices can be used when redeeming vouchers.</p>
@endsection
