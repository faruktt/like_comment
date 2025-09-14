
@extends('admin.admin_dash')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">Add Category</div>
            <div class="card-body">
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="category_name" class="form-control">
                    </div>
                    <div class="mb-3">
                       <button type="submit" class="btn btn-primary">Add New</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">All Caregory</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>Category </th>
                        <th>status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($category as $item )


                        <tr>
                            <td>{{ $item->category_name }}</td>
                            <td>
                                {{ $item->status == 1 ? 'active':'inactive'  }}
                            </td>
                           <td>
                                <!-- Edit Button -->
                                <a href="" class=" text-info btn-sm">
                                    <i class="fas fa-edit">Edit</i>
                                </a>

                                <!-- Delete Button -->
                                <a href="" class="btn btn-sm">
                                    <i class="fas fa-trash-alt text-danger">Delete</i>
                                </a>

                                <!-- Active/Inactive Button -->
                                @if($item->status == 1)
                                <a href="{{ route('category.deactive', $item->id) }}" class="btn btn-sm">
                                    <i class="fa-solid fa-eye-slash text-info">deactive</i>
                                </a>
                            @else
                                <a href="{{ route('category.active', $item->id) }}" class="btn btn-sm">
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

@endsection
