@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Voucher</h1>
        <a href="{{ route('admin.vouchers.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-ticket-alt fa-sm"></i> Tambah Voucher
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Tipe</th>
                            <th>Nilai</th>
                            <th>Berlaku</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vouchers as $voucher)
                        <tr>
                            <td class="font-weight-bold">{{ $voucher->code }}</td>
                            <td>{{ ucfirst($voucher->discount_type) }}</td>
                            <td>
                                {{ $voucher->discount_type == 'fixed' ? 'Rp '.number_format($voucher->discount_value, 0, ',', '.') : $voucher->discount_value.'%' }}
                            </td>
                            <td>{{ date('d/m/y', strtotime($voucher->start_date)) }} - {{ date('d/m/y', strtotime($voucher->end_date)) }}</td>
                            <td>
                                <span class="badge badge-{{ $voucher->status ? 'success' : 'secondary' }}">
                                    {{ $voucher->status ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.vouchers.edit', $voucher) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.vouchers.destroy', $voucher) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus voucher?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $vouchers->links() }}
        </div>
    </div>
</div>
@endsection