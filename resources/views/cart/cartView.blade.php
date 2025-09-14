@extends('fontend.fontend')
@section('content')

 <div class="col-lg-8">
        <div class="card">
            <div class="card-header">All Cart</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>Image </th>
                        <th>product</th>
                        <th>price</th>
                        <th>quantity</th>
                        <th>action</th>
                    </thead>
                    <tbody>
                        @foreach ($products as $item )


                        <tr>
                            <td><img src="{{ asset('uploads') }}/{{ $item->product->product_image }}" alt="" width="60"></td>
                            <td>{{ $item->product->product_name }}</td>
                            <td>{{ $item->product->product_price }}</td>
                            <td>
                                {{ $item->quantity }}
                            </td>
                           <td>

                                <!-- Delete Button -->
                                <a href="{{ route('cart.single', $item->id) }}" class="btn btn-sm">
                                    <i class="fas fa-trash-alt text-primary">Order</i>
                                </a>
                                <a href="{{ route('cart.delete', $item->id) }}" class="btn btn-sm">
                                    <i class="fas fa-trash-alt text-danger">cancel</i>
                                </a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
