@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="h3">Pre-Order Management</h1>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-warning">
                <div class="card-body">
                    <h5>Pending</h5>
                    <h2>{{ $stats['pending'] ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info">
                <div class="card-body">
                    <h5>Confirmed</h5>
                    <h2>{{ $stats['confirmed'] ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-primary">
                <div class="card-body">
                    <h5>In Production</h5>
                    <h2>{{ $stats['in_production'] ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success">
                <div class="card-body">
                    <h5>Delivery Today</h5>
                    <h2>{{ $stats['delivery_today'] ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Daftar Pre-Order</h3>
                <a href="{{ route('admin.pre-orders.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Buat Pre-Order Baru
                </a>
            </div>
        </div>
        <div class="card-body">
            {{-- Filter --}}
            <form method="GET" class="mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <select name="status" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="in_production">In Production</option>
                            <option value="ready">Ready</option>
                            <option value="completed">Completed</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="payment_status" class="form-control">
                            <option value="">Semua Payment</option>
                            <option value="unpaid">Unpaid</option>
                            <option value="dp_paid">DP Paid</option>
                            <option value="paid">Paid</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="delivery_date" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-secondary">Filter</button>
                        <a href="{{ route('admin.pre-orders.index') }}" class="btn btn-light">Reset</a>
                    </div>
                </div>
            </form>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Delivery Date</th>
                        <th>Total Price</th>
                        <th>Payment Status</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($preOrders as $po)
                    <tr>
                        <td><strong>{{ $po->order_number }}</strong></td>
                        <td>{{ $po->customer->name }}</td>
                        <td>{{ $po->product_name }}</td>
                        <td>{{ $po->delivery_date->format('d M Y H:i') }}</td>
                        <td>Rp {{ number_format($po->total_price, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge badge-{{ $po->payment_status_badge }}">
                                {{ ucfirst($po->payment_status) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-{{ $po->status_badge }}">
                                {{ ucfirst($po->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.pre-orders.show', $po) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if($po->status === 'pending')
                            <a href="{{ route('admin.pre-orders.edit', $po) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data pre-order</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $preOrders->links() }}
        </div>
    </div>
</div>
@endsection