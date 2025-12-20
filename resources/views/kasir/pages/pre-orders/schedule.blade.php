@extends('kasir.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Kalender Produksi (7 Hari ke Depan)</h1>

    <div class="row">
        @foreach($preOrders as $date => $orders)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-dark text-white font-weight-bold">
                    {{ \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMMM Y') }}
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($orders as $order)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <span><strong>{{ $order->product_name }}</strong></span>
                            <span class="badge badge-secondary">{{ $order->quantity }} pcs</span>
                        </div>
                        <small class="text-muted">{{ $order->customer->name }} - {{ strtoupper($order->status) }}</small>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection