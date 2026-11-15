{{--
    Master Layout (View layer of MVC)
    ---------------------------------
    All customer pages extend this layout using @extends('layouts.app').
    It holds the shared HTML skeleton, navigation bar, styles and footer so
    every page looks consistent. Child pages inject content into @yield('content').
    Styles are self-contained (no CDN / npm build needed).
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Customer List') | Customer Management System</title>

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --male: #2563eb;
            --male-bg: #dbeafe;
            --female: #db2777;
            --female-bg: #fce7f3;
            --success: #059669;
            --success-bg: #d1fae5;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #e5e7eb;
            --bg: #f3f4f6;
            --white: #ffffff;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 14px;
            color: var(--text);
            background: var(--bg);
        }

        a { color: var(--primary); text-decoration: none; }
        a:hover { text-decoration: underline; }

        .container { max-width: 1280px; margin: 0 auto; padding: 0 20px; }

        /* ---------- Navbar ---------- */
        .navbar { background: var(--primary); box-shadow: 0 2px 6px rgba(0, 0, 0, .15); }
        .navbar .container {
            display: flex; flex-wrap: wrap; align-items: center;
            justify-content: space-between; gap: 10px; padding-top: 14px; padding-bottom: 14px;
        }
        .brand { color: var(--white); font-size: 18px; font-weight: 700; }
        .brand:hover { text-decoration: none; }
        .nav-links { display: flex; flex-wrap: wrap; gap: 6px; list-style: none; margin: 0; padding: 0; }
        .nav-links a {
            display: block; color: rgba(255, 255, 255, .85);
            padding: 7px 14px; border-radius: 6px; font-weight: 500;
        }
        .nav-links a:hover { background: rgba(255, 255, 255, .15); color: var(--white); text-decoration: none; }
        .nav-links a.active { background: var(--white); color: var(--primary); font-weight: 600; }

        main { padding: 28px 0 40px; }

        /* ---------- Page header ---------- */
        .page-header {
            display: flex; flex-wrap: wrap; justify-content: space-between;
            align-items: center; gap: 12px; margin-bottom: 20px;
        }
        .page-title { border-left: 5px solid var(--primary); padding-left: 12px; }
        .page-title h1 { margin: 0 0 4px; font-size: 24px; }
        .page-title p { margin: 0; color: var(--muted); }

        /* ---------- Badges ---------- */
        .badge {
            display: inline-block; padding: 4px 10px; border-radius: 999px;
            font-size: 12px; font-weight: 600; white-space: nowrap;
        }
        .badge-lg { font-size: 14px; padding: 7px 16px; }
        .badge-total   { background: #374151; color: var(--white); }
        .badge-male    { background: var(--male-bg); color: var(--male); }
        .badge-female  { background: var(--female-bg); color: var(--female); }
        .badge-success { background: var(--success-bg); color: var(--success); }

        /* ---------- Cards ---------- */
        .card {
            background: var(--white); border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .08); margin-bottom: 20px; overflow: hidden;
        }
        .card-body { padding: 14px 18px; }

        /* ---------- Filter bar ---------- */
        .filter-bar { display: flex; flex-wrap: wrap; align-items: center; gap: 8px; }
        .filter-bar .label { font-weight: 600; margin-right: 6px; }
        .filter-bar .spacer { flex: 1; }

        .btn {
            display: inline-block; padding: 6px 14px; border-radius: 6px;
            border: 1px solid transparent; font-size: 13px; font-weight: 500; cursor: pointer;
        }
        .btn:hover { text-decoration: none; filter: brightness(.95); }
        .btn-male           { border-color: var(--male); color: var(--male); background: var(--white); }
        .btn-male.active    { background: var(--male); color: var(--white); }
        .btn-female         { border-color: var(--female); color: var(--female); background: var(--white); }
        .btn-female.active  { background: var(--female); color: var(--white); }
        .btn-success        { border-color: var(--success); color: var(--success); background: var(--white); }
        .btn-success.active { background: var(--success); color: var(--white); }
        .btn-secondary      { border-color: var(--border); color: var(--muted); background: var(--white); }

        /* ---------- Table ---------- */
        .table-wrapper { overflow-x: auto; }
        table.customer-table { width: 100%; border-collapse: collapse; }
        .customer-table th {
            background: #1f2937; color: var(--white); text-align: left;
            padding: 12px 14px; font-weight: 600; white-space: nowrap;
        }
        .customer-table td { padding: 11px 14px; border-bottom: 1px solid var(--border); vertical-align: middle; }
        .customer-table tbody tr:nth-child(even) { background: #f9fafb; }
        .customer-table tbody tr:hover { background: #eff6ff; }
        .customer-table .text-center { text-align: center; }
        .customer-table .nowrap { white-space: nowrap; }
        .customer-table .col-no { width: 60px; color: var(--muted); }
        .customer-table .col-name { font-weight: 600; white-space: nowrap; }
        .customer-table .col-address { min-width: 260px; }
        .empty-row { text-align: center; color: var(--muted); padding: 30px !important; }

        /* ---------- Pagination ---------- */
        .table-footer {
            display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center;
            gap: 10px; padding: 14px 18px; border-top: 1px solid var(--border); color: var(--muted);
        }
        .pagination { display: flex; flex-wrap: wrap; gap: 4px; list-style: none; margin: 0; padding: 0; }
        .pagination a, .pagination span {
            display: block; min-width: 34px; padding: 6px 10px; text-align: center;
            border: 1px solid var(--border); border-radius: 6px; color: var(--text); background: var(--white);
        }
        .pagination a:hover { background: var(--bg); text-decoration: none; }
        .pagination .active span { background: var(--primary); border-color: var(--primary); color: var(--white); }
        .pagination .disabled span { color: #c0c4cc; }

        /* ---------- Footer ---------- */
        footer {
            text-align: center; color: var(--muted); font-size: 12px;
            padding: 16px; border-top: 1px solid var(--border); background: var(--white);
        }
    </style>
</head>
<body>

    {{-- ===== Navigation Bar ===== --}}
    @php $currentGender = request()->route('gender'); @endphp
    <nav class="navbar">
        <div class="container">
            <a class="brand" href="{{ route('customers.index') }}">Customer Management System</a>
            <ul class="nav-links">
                <li>
                    <a href="{{ route('customers.index') }}"
                       class="{{ request()->routeIs('customers.index') ? 'active' : '' }}">All Customers</a>
                </li>
                <li>
                    <a href="{{ route('customers.gender', 'Male') }}"
                       class="{{ request()->routeIs('customers.gender') && $currentGender === 'Male' ? 'active' : '' }}">&#9794; Male</a>
                </li>
                <li>
                    <a href="{{ route('customers.gender', 'Female') }}"
                       class="{{ request()->routeIs('customers.gender') && $currentGender === 'Female' ? 'active' : '' }}">&#9792; Female</a>
                </li>
                <li>
                    <a href="{{ route('customers.birthday') }}"
                       class="{{ request()->routeIs('customers.birthday') ? 'active' : '' }}">Born After 2000</a>
                </li>
            </ul>
        </div>
    </nav>

    {{-- ===== Page Content ===== --}}
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- ===== Footer ===== --}}
    <footer>
        BCS3453 Integrated Application Development Framework &middot; Assignment 2 &middot;
        Customer Management Website (Laravel + Faker)
    </footer>

</body>
</html>