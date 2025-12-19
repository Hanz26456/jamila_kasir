@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Laporan Penjualan</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.reports.sales') }}" method="GET" class="form-inline">
                <div class="form-group mr-3">
                    <label class="mr-2 small font-weight-bold text-uppercase">Dari:</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $start_date }}">
                </div>
                <div class="form-group mr-3">
                    <label class="mr-2 small font-weight-bold text-uppercase">Sampai:</label>
                    <input type="date" name="end_date" class="form-control" value="{{ $end_date }}">
                </div>
                <button type="submit" class="btn btn-primary shadow-sm">
                    <i class="fas fa-filter fa-sm"></i> Filter Laporan
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pendapatan Bersih</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($total_revenue, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Transaksi</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $sales->count() }} Order</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Data Transaksi Berhasil</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th>Tgl Transaksi</th>
                            <th>Order ID</th>
                            <th>Pelanggan</th>
                            <th>Metode Bayar</th>
                            <th class="text-right">Total Bayar</th>
                            <th class="text-right">Kembalian</th>
                            <th class="text-right">Total Net</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr>
                            <td class="small">{{ \Carbon\Carbon::parse($sale->order_date)->format('d/m/Y H:i') }}</td>
                            <td class="font-weight-bold text-dark">#{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $sale->customer->name }}</td>
                            <td>
                                <span class="badge badge-secondary px-2 py-1">
                                    {{ strtoupper($sale->payment?->payment_method ?? 'N/A') }}
                                </span>
                            </td>
                            <td class="text-right">Rp {{ number_format($sale->payment?->amount ?? 0, 0, ',', '.') }}</td>
                            <td class="text-right text-muted small">Rp {{ number_format($sale->payment?->change ?? 0, 0, ',', '.') }}</td>
                            <td class="text-right font-weight-bold text-primary">
                                Rp {{ number_format($sale->total_price, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">Tidak ada transaksi pada periode ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection