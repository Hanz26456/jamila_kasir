@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Detail Pre-Order #{{ $preOrder->order_number }}</h1>
        <div>
            <a href="{{ route('admin.pre-orders.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm"></i> Kembali
            </a>
            <a href="{{ route('admin.pre-orders.print', $preOrder) }}" target="_blank" class="btn btn-primary shadow-sm">
                <i class="fas fa-print fa-sm"></i> Cetak Struk
            </a>
        </div>
    </div>

    {{-- Tombol Aksi Cepat --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow py-2 px-3 flex-row justify-content-start gap-2">
                {{-- Edit --}}
                @if($preOrder->status === 'pending')
                    <a href="{{ route('admin.pre-orders.edit', $preOrder) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit Pesanan
                    </a>
                @endif

                {{-- Pembayaran DP --}}
                @if($preOrder->payment_status === 'unpaid')
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalPayDP">
                        <i class="fas fa-money-bill-wave"></i> Bayar DP
                    </button>
                @endif

                {{-- Pelunasan --}}
                @if($preOrder->payment_status === 'dp_paid')
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalPayRemaining">
                        <i class="fas fa-check-double"></i> Pelunasan
                    </button>
                @endif

                {{-- Update Status Produksi --}}
                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalUpdateStatus">
                    <i class="fas fa-sync"></i> Update Status
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Info Utama & Detail Produk --}}
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pesanan & Produk</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Produk</th>
                            <td>: <strong>{{ $preOrder->product_name }}</strong></td>
                        </tr>
                        <tr>
                            <th>Status Produksi</th>
                            <td>: <span class="badge badge-info">{{ strtoupper($preOrder->status) }}</span></td>
                        </tr>
                        <tr>
                            <th>Status Bayar</th>
                            <td>: <span class="badge badge-warning">{{ strtoupper(str_replace('_', ' ', $preOrder->payment_status)) }}</span></td>
                        </tr>
                        <tr>
                            <th>Tgl Pengiriman</th>
                            <td>: {{ \Carbon\Carbon::parse($preOrder->delivery_date)->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Metode</th>
                            <td>: {{ strtoupper($preOrder->delivery_method) }}</td>
                        </tr>
                    </table>
                    <hr>
                    <h6><strong>Deskripsi / Catatan:</strong></h6>
                    <p>{{ $preOrder->description }}</p>
                </div>
            </div>

            {{-- Riwayat Status --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Riwayat Status Produksi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                    <th>Catatan</th>
                                    <th>Oleh</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($preOrder->statusHistories as $history)
                                <tr>
                                    <td>{{ $history->changed_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ strtoupper($history->new_status) }}</td>
                                    <td>{{ $history->notes }}</td>
                                    <td>{{ $history->changer->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Info Customer & Keuangan --}}
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Keuangan</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Harga:</span>
                        <strong>Rp {{ number_format($preOrder->total_price, 0, ',', '.') }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2 text-success">
                        <span>Sudah Bayar (DP):</span>
                        <strong>Rp {{ number_format($preOrder->dp_amount, 0, ',', '.') }}</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="h5">SISA TAGIHAN:</span>
                        <span class="h5 font-weight-bold text-danger">Rp {{ number_format($preOrder->remaining_payment, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL: UPDATE STATUS --}}
<div class="modal fade" id="modalUpdateStatus" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.pre-orders.update-status', $preOrder) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Status Produksi</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status Baru</label>
                        <select name="status" class="form-control" required>
                            <option value="pending" {{ $preOrder->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $preOrder->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="in_production" {{ $preOrder->status == 'in_production' ? 'selected' : '' }}>In Production</option>
                            <option value="ready" {{ $preOrder->status == 'ready' ? 'selected' : '' }}>Ready for Pickup</option>
                            <option value="completed" {{ $preOrder->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="canceled" {{ $preOrder->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea name="notes" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- MODAL: BAYAR DP --}}
<div class="modal fade" id="modalPayDP" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.pre-orders.pay-dp', $preOrder) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content text-dark">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Pembayaran DP</h5>
                </div>
                <div class="modal-body">
                    <p>Minimal DP: <strong>Rp {{ number_format($preOrder->dp_amount, 0, ',', '.') }}</strong></p>
                    <div class="form-group">
                        <label>Metode</label>
                        <select name="payment_method" class="form-control" required>
                            <option value="cash">Cash</option>
                            <option value="qris">QRIS</option>
                            <option value="bank_transfer">Transfer Bank</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nominal Bayar</label>
                        <input type="number" name="amount" class="form-control" value="{{ $preOrder->dp_amount }}" min="{{ $preOrder->dp_amount }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Proses DP</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- MODAL: PELUNASAN --}}
<div class="modal fade" id="modalPayRemaining" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.pre-orders.pay-remaining', $preOrder) }}" method="POST">
            @csrf
            <div class="modal-content text-dark">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Proses Pelunasan</h5>
                </div>
                <div class="modal-body text-center">
                    <p>Sisa Tagihan:</p>
                    <h2 class="font-weight-bold">Rp {{ number_format($preOrder->remaining_payment, 0, ',', '.') }}</h2>
                    <div class="form-group text-left">
                        <label>Metode Pembayaran</label>
                        <select name="payment_method" class="form-control" required>
                            <option value="cash">Cash</option>
                            <option value="qris">QRIS</option>
                            <option value="bank_transfer">Transfer Bank</option>
                        </select>
                    </div>
                    <input type="hidden" name="amount" value="{{ $preOrder->remaining_payment }}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Konfirmasi Lunas</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection