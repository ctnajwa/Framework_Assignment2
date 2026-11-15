{{--
    Reusable Customer Table (partial view)
    --------------------------------------
    Included by index, gender and birthday pages with:
        @include('customers.partials.table', ['customers' => $customers])

    Columns required by the assignment:
        Name | Email | Address | Phone Number | Gender | Birthday

    Works with both a Collection (Customer::all() / ->get())
    and a Paginator (->paginate()) passed from the controller.
--}}
@php
    $isPaginated = $customers instanceof \Illuminate\Pagination\LengthAwarePaginator;
    $offset = $isPaginated ? ($customers->firstItem() ?? 1) - 1 : 0;
@endphp

<div class="card">
    <div class="table-wrapper">
        <table class="customer-table">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th class="text-center">Gender</th>
                    <th>Birthday</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                    <tr>
                        <td class="text-center col-no">{{ $offset + $loop->iteration }}</td>
                        <td class="col-name">{{ $customer->name }}</td>
                        <td><a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a></td>
                        <td class="col-address">{{ $customer->address }}</td>
                        <td class="nowrap">{{ $customer->phoneNumber }}</td>
                        <td class="text-center">
                            @if ($customer->gender === 'Male')
                                <span class="badge badge-male">&#9794; Male</span>
                            @else
                                <span class="badge badge-female">&#9792; Female</span>
                            @endif
                        </td>
                        <td class="nowrap">{{ \Carbon\Carbon::parse($customer->birthday)->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty-row">No customer records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Record summary + pagination (pagination only if controller uses ->paginate()) --}}
    <div class="table-footer">
        <span>
            @if ($isPaginated)
                Showing {{ $customers->firstItem() ?? 0 }} to {{ $customers->lastItem() ?? 0 }}
                of {{ $customers->total() }} records
            @else
                Showing {{ $customers->count() }} records
            @endif
        </span>

        @if ($isPaginated)
            {{ $customers->onEachSide(1)->links('customers.partials.pagination') }}
        @endif
    </div>
</div>