@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Manajemen Voucher</h1>
        <a href="{{ route('admin.vouchers.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-ticket-alt fa-sm"></i> Tambah Voucher
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>Kode</th>
                            <th>Produk Terkait</th> {{-- KOLOM BARU --}}
                            <th>Diskon</th>
                            <th width="15%">Pemakaian</th>
                            <th>Berlaku</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vouchers as $voucher)
                        <tr>
                            <td class="font-weight-bold text-dark">{{ $voucher->code }}</td>
                            
                            {{-- TAMPILAN PRODUK TERKAIT --}}
                            <td>
                                @if($voucher->products->count() > 0)
                                    @foreach($voucher->products as $product)
                                        <span class="badge badge-outline-primary border border-primary text-primary px-2 py-1 mb-1">
                                            <i class="fas fa-tag fa-xs"></i> {{ $product->name }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="badge badge-light border text-muted px-2 py-1">
                                        <i class="fas fa-globe fa-xs"></i> Semua Produk
                                    </span>
                                @endif
                            </td>

                            <td>
                                <span class="font-weight-bold text-success">
                                    {{ $voucher->discount_type == 'fixed' ? 'Rp '.number_format($voucher->discount_value, 0, ',', '.') : $voucher->discount_value.'%' }}
                                </span>
                            </td>

                            <td>
                                @if($voucher->usage_limit > 0)
                                    <div class="small mb-1 font-weight-bold">
                                        {{ $voucher->used_count }} / {{ $voucher->usage_limit }}
                                    </div>
                                    <div class="progress progress-sm" style="height: 8px;">
                                        @php 
                                            $percent = ($voucher->used_count / $voucher->usage_limit) * 100;
                                            $barColor = $percent >= 100 ? 'bg-danger' : ($percent >= 80 ? 'bg-warning' : 'bg-success');
                                        @endphp
                                        <div class="progress-bar {{ $barColor }}" style="width: {{ $percent }}%"></div>
                                    </div>
                                    @if($voucher->used_count >= $voucher->usage_limit)
                                        <small class="text-danger font-weight-bold">Kuota Habis!</small>
                                    @endif
                                @else
                                    <span class="badge badge-info">Tak Terbatas</span>
                                @endif
                            </td>

                            <td class="small">
                                {{ date('d/m/y', strtotime($voucher->start_date)) }} - {{ date('d/m/y', strtotime($voucher->end_date)) }}
                            </td>
                            
                            <td>
                                <span class="badge badge-{{ $voucher->status ? 'success' : 'secondary' }}">
                                    {{ $voucher->status ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>

                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.vouchers.edit', $voucher) }}" class="btn btn-sm btn-warning shadow-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.vouchers.destroy', $voucher) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus voucher?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger shadow-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $vouchers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection