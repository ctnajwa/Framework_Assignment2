{{--
    Customer List Page
    ------------------
    Route : GET /customers           (name: customers.index)
    Data  : $customers  -> all customer records from CustomerController@index
--}}
@extends('layouts.app')

@section('title', 'All Customers')

@section('content')
    @php
        $total = $customers instanceof \Illuminate\Pagination\LengthAwarePaginator
            ? $customers->total()
            : $customers->count();
    @endphp

    {{-- Page header --}}
    <div class="page-header">
        <div class="page-title">
            <h1>Customer List</h1>
            <p>All customer records generated using Laravel Factory &amp; Faker</p>
        </div>
        <span class="badge badge-lg badge-total">Total: {{ $total }} customers</span>
    </div>

    {{-- Quick filter buttons --}}
    <div class="card">
        <div class="card-body filter-bar">
            <span class="label">Filter by:</span>
            <a href="{{ route('customers.gender', 'Male') }}" class="btn btn-male">&#9794; Male</a>
            <a href="{{ route('customers.gender', 'Female') }}" class="btn btn-female">&#9792; Female</a>
            <a href="{{ route('customers.birthday') }}" class="btn btn-success">Born After 2000</a>
        </div>
    </div>

    {{-- Customer table --}}
    @include('customers.partials.table', ['customers' => $customers])
@endsection