{{--
    Filter by Birthday Page
    -----------------------
    Route : GET /customers/birthday   (name: customers.birthday)
    Data  : $customers -> customers born after the year 2000
                          (birthday from 2001-01-01 onwards)
--}}
@extends('layouts.app')

@section('title', 'Customers Born After 2000')

@section('content')
    @php
        $total = $customers instanceof \Illuminate\Pagination\LengthAwarePaginator
            ? $customers->total()
            : $customers->count();
    @endphp

    {{-- Page header --}}
    <div class="page-header">
        <div class="page-title">
            <h1>Customers Born After 2000</h1>
            <p>Showing customers whose birthday is after the year 2000 (from 1 January 2001 onwards)</p>
        </div>
        <span class="badge badge-lg badge-success">{{ $total }} customers</span>
    </div>

    {{-- Filter info --}}
    <div class="card">
        <div class="card-body filter-bar">
            <span class="label">Active filter:</span>
            <span class="badge badge-success">Birth year &gt; 2000</span>
            <span class="spacer"></span>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">&times; Clear Filter</a>
        </div>
    </div>

    {{-- Filtered customer table --}}
    @include('customers.partials.table', ['customers' => $customers])
@endsection