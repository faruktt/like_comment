
@extends('admin.admin_dash')
@section('content')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">Add Product</div>
            <div class="card-body">
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="product_image" class="form-control"
                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                </div>

                <!-- Preview -->
                <div class="mb-3">
                    <img id="blah" src="#" alt="Image Preview" style="max-height: 150px; display: none;" onload="this.style.display='block'">
                </div>


                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="product_category" class="form-control select2" required>
                            <option value=""></option>
                            @foreach($category as $categor)
                                <option value="{{ $categor->id }}">{{ $categor->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="product_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="text" name="product_price" class="form-control">
                    </div>

                    <div class="mb-3">
                       <button type="submit" class="btn btn-primary">Add New</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">All Caregory</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>Image </th>
                        <th>Category </th>
                        <th>product</th>
                        <th>price</th>
                        <th>status</th>
                        <th>action</th>
                    </thead>
                    <tbody>
                        @foreach ($product as $item )


                        <tr>
                            <td><img src="{{ asset('uploads') }}/{{ $item->product_image }}" alt="" width="60"></td>
                            <td>{{ $item->category->category_name ?? 'No Category' }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->product_price }}</td>
                            <td>
                                {{ $item->status == 1 ? 'active':'inactive'  }}
                            </td>
                           <td>
                                <!-- Edit Button -->
                                <a href="" class=" text-info btn-sm">
                                    <i class="fas fa-edit">Edit</i>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('product.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>

                                <!-- Active/Inactive Button -->
                                @if($item->status == 1)
                                <a href="{{ route('product.deactive', $item->id) }}" class="btn btn-sm">
                                    <i class="fa-solid fa-eye-slash text-info">deactive</i>
                                </a>
                            @else
                                <a href="{{ route('product.active', $item->id) }}" class="btn btn-sm">
                                    <i class="fa-solid fa-eye text-success">active</i>
                                </a>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "-- Select Category --",
            allowClear: true
        });
    });
</script>



@endsection
