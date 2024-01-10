@extends('layouts.form')
@section('content')
    <form action="{{ route(str($resource) . '.buy', [Str::singular($resource) => $primary]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <p>You may upload your invoice below. Invoices can only be used once.</p>
        <div class="mt-3">
            <label>Invoice</label>
            <input name="invoice" type="file" class="form-control">
        </div>
        <div class="d-flex justify-content-end mt-3">
            <button class="btn btn-success" type="submit">Upload</button>
        </div>
    </form>
@endsection
