@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Laporan Penjualan</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.reports.sales') }}" method="GET" class="form-inline">
                <input type="date" name="start_date" class="form-control mr-2" value="{{ $start_date }}">
                <input type="date" name="end_date" class="form-control mr-2" value="{{ $end_date }}">
                <button type="submit" class="btn btn-primary">Filter Laporan</button>
            </form>
        </div>
    </div>

    <div class="card border-left-success shadow mb-4">
        <div class="card-body">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pendapatan (Periode Ini)</div>
            <div class="h3 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($total_revenue, 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Transaksi Berhasil</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>Tgl Transaksi</th>
                            <th>Order ID</th>
                            <th>Pelanggan</th>
                            <th>Metode Bayar</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr>
                            <td>{{ $sale->order_date }}</td>
                            <td>#{{ $sale->id }}</td>
                            <td>{{ $sale->customer->name }}</td>
                            <td>{{ strtoupper($sale->payment->payment_method) }}</td>
                            <td>Rp {{ number_format($sale->total_price, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">Tidak ada transaksi pada periode ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection