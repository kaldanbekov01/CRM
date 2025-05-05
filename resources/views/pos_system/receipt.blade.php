<!-- resources/views/pos_system/receipt.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="receipt-wrapper">
            <div class="receipt-box">
                <div class="title">ИП «DEMO»</div>
                <div class="subtitle">BIN (IIN): 999999999999<br>DEMO St., 1</div>
                <h2 data-i18n="cheque_title">PRELIMINARY RECEIPT</h2>

                <div class="auto">
                    <h4><strong data-i18n="auto">AUTONOMOUS</strong></h4>
                    <div class="details">
                        <div><strong data-i18n="sale">Sale</strong>: No. {{ $order->id }}</div>
                        <div><strong data-i18n="shift">Shift</strong>: 2</div>
                        <div><strong data-i18n="cashier">Cashier</strong>: 773178</div>
                        <div><strong data-i18n="date">Date</strong>: <span id="date">{{ now()->toDateString() }}</span></div>
                        <div><strong data-i18n="time">Time</strong>: <span id="time">{{ now()->toTimeString() }}</span></div>
                    </div>
                </div>

                <hr style="color: white;">

                <div class="items" id="items-container">
                    @foreach ($order->basket as $item)
                        <div class="item">
                            <div>{{ $loop->iteration }}. '{{ $item->product->name }}'<br><small>{{ $item->quantity }} × {{ number_format($item->product->price, 2) }} KZT</small></div>
                            <div>{{ number_format($item->product->price * $item->quantity, 2) }} KZT</div>
                        </div>
                    @endforeach
                </div>

                <hr style="color: white;">

                <div class="total">
                    <div><strong data-i18n="total">TOTAL</strong></div>
                    <div class="total-amount" id="totalAmount">{{ number_format($order->total_amount, 2) }} KZT</div>
                </div>

                <div class="payment-method">
                    <div id="paymentMethod">{{ ucfirst($order->payment_method) }}</div>
                    <div id="paidAmount">{{ number_format($order->total_amount, 2) }} KZT</div>
                </div>
            </div>
        </div>
    </div>
@endsection
