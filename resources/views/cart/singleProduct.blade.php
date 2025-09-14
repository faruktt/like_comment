@extends('fontend.fontend')
@section('content')

<div class="container my-4" style="width: 50%" >
    <h4>🛒 Your Cart</h4>

    @foreach ($cartItem as $item)
        <div class="card mb-3 shadow-sm">
            <div class="row g-0 align-items-center">
                <!-- Image -->
                <div class="col-md-2 text-center">
                    <img src="{{ asset('uploads/' . $item->product->product_image) }}"
                         class="img-fluid rounded-start" alt="..." style="height: 100px; object-fit: cover;">
                </div>

                <!-- Product Info -->
                <div class="col-md-6">
                    <div class="card-body">
                        <h6 class="card-title mb-1">{{ $item->product->product_name }}</h6>
                        <p class="mb-0 text-muted">Price: ৳<span class="unit-price">{{ $item->product->product_price }}</span></p>
                    </div>
                </div>

                <!-- Quantity Input -->
                <div class="col-md-2 text-center">
                    <label for="qty{{ $item->id }}" class="form-label mb-0">Qty</label>
                    <input type="number" class="form-control text-center qty-input"
                           value="{{ $item->quantity ?? 1 }}" min="1"
                           data-price="{{ $item->product->product_price }}">
                </div>

                <!-- Total Price -->
                <div class="col-md-2 text-center">
                    <strong class="text-success">৳ <span class="total-price">
                        {{ $item->product->product_price * ($item->quantity ?? 1) }}
                    </span></strong>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Pay Now Button -->
    <div class="text-end">
        <a href="{{ route('pay.now') }}" class="btn btn-success px-4 py-2">💳 Pay Now</a>
    </div>
</div>

<!-- Script for quantity live update -->
<script>
    document.querySelectorAll('.qty-input').forEach(input => {
        input.addEventListener('input', function() {
            let price = parseFloat(this.dataset.price);
            let qty = parseInt(this.value);
            let total = price * qty;
            let totalPriceEl = this.closest('.row').querySelector('.total-price');
            totalPriceEl.textContent = total.toFixed(2);
        });
    });
</script>

@endsection
