
@extends('admin.admin_dash')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">Add Category</div>
            <div class="card-body">
                <form action="" method="">
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

    <div class="col-lg-4">
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
                    <tr>
                        <td>mobile</td>
                        <td>mobile</td>
                        <td>mobile</td>
                    </tr>
                 </tbody>
            </table>
          </div>
        </div>
    </div>
</div>

@endsection
