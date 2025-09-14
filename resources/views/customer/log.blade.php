@extends('fontend.fontend')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">Log in</div>
            <div class="card-body">
                <form action="{{ route('customer.fontend') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="mb-3">
                       <button type="submit" class="btn btn-primary">Add New</button>
                       <p>don't have an account
                        <a href="{{ route('customer.reg') }}">Singup</a>
                       </p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
