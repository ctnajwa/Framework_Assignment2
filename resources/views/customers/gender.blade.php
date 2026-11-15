{{--
    Filter by Gender Page
    ---------------------
    Route : GET /customers/gender/{gender}   (name: customers.gender)
    Data  : $customers -> customers where gender = $gender
            $gender    -> 'Male' or 'Female' (selected filter)
--}}
@extends('layouts.app')

@section('title', $gender . ' Customers')

@section('content')
    @php
        $total = $customers instanceof \Illuminate\Pagination\LengthAwarePaginator
            ? $customers->total()
            : $customers->count();
        $isMale = $gender === 'Male';
    @endphp

    {{-- Page header --}}
    <div class="page-header">
        <div class="page-title">
            <h1>{!! $isMale ? '&#9794;' : '&#9792;' !!} {{ $gender }} Customers</h1>
            <p>Showing customers filtered by gender: <strong>{{ $gender }}</strong></p>
        </div>
        <span class="badge badge-lg {{ $isMale ? 'badge-male' : 'badge-female' }}">
            {{ $total }} {{ strtolower($gender) }} customers
        </span>
    </div>

    {{-- Gender filter toggle --}}
    <div class="card">
        <div class="card-body filter-bar">
            <span class="label">Gender:</span>
            <a href="{{ route('customers.gender', 'Male') }}"
               class="btn btn-male {{ $isMale ? 'active' : '' }}">&#9794; Male</a>
            <a href="{{ route('customers.gender', 'Female') }}"
               class="btn btn-female {{ ! $isMale ? 'active' : '' }}">&#9792; Female</a>
            <span class="spacer"></span>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">&times; Clear Filter</a>
        </div>
    </div>

    {{-- Filtered customer table --}}
    @include('customers.partials.table', ['customers' => $customers])
@endsection