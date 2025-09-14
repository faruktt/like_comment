@extends('fontend.master')
@section('content')

<style>
/* Main comment input */
.main-comment-box {
    margin-bottom: 10px;
}

/* Scrollable comments container */
.comments-scroll {
    max-height: 250px;
    overflow-y: auto;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
}

/* Single comment */
.comment {
    border-left: 2px solid #ccc;
    padding-left: 10px;
    margin-bottom: 10px;
    cursor: pointer;
}

/* Reply container */
.reply {
    margin-left: 20px;
    border-left: 1px dashed #bbb;
    padding-left: 8px;
    margin-bottom: 5px;
}

/* Hidden reply form */
.reply-form {
    display: none;
    margin-top: 5px;
}
</style>

<div class="container mt-4">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-md-5 g-3">
        @foreach(App\Models\Product::with('category')->get() as $item)
            <div class="col">
                <div class="card h-100 shadow-sm" style="font-size: 14px;">
                    <!-- Product Image -->
                    <img src="{{ asset('uploads/' . ($item->product_image ?? 'default.png')) }}"
                         alt="{{ $item->product_name }}"
                         class="card-img-top"
                         style="height: 100px; object-fit: cover;">

                    <div class="card-body p-2">
                        <h6 class="card-title mb-1">{{ $item->product_name }}</h6>
                        <p class="mb-1">Category: {{ $item->category->category_name ?? 'No Category' }}</p>
                        <p class="mb-2">Price: ৳{{ $item->product_price }}</p>
                        <a href="{{ route('cart.add.get', $item->id) }}" class="btn btn-sm btn-primary w-100 mb-2">Add to Cart</a>

                        <!-- Main Comment Input -->
                        <div class="main-comment-box">
                            <form action="{{ route('product.comment.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                <input type="text" name="content" class="form-control form-control-sm" placeholder="Add a comment...">
                            </form>
                        </div>

                        <!-- Scrollable Comments -->
                        <div class="comments-scroll">
                            @php
                                $comments = App\Models\ProductComment::where('product_id', $item->id)
                                            ->whereNull('parent_id')
                                            ->with('replies.customer')
                                            ->get();
                            @endphp

                            @foreach($comments as $comment)
                                <div class="comment" onclick="toggleReplyForm({{ $comment->id }})">
                                    <strong>{{ $comment->customer->name ?? 'Guest' }}</strong>: {{ $comment->content }}
                                    <span class="text-muted">({{ $comment->replies->count() }} replies)</span>

                                    <!-- Reply Form -->
                                    <form action="{{ route('product.comment.reply', $comment->id) }}" method="POST" class="reply-form" id="reply-form-{{ $comment->id }}">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                        <input type="text" name="content" class="form-control form-control-sm mb-1" placeholder="Reply...">
                                        <button type="submit" class="btn btn-sm btn-secondary">Reply</button>
                                    </form>

                                    <!-- Nested Replies -->
                                    @if($comment->replies->count())
                                        @include('fontend.partials.product-replies', ['replies' => $comment->replies, 'level' => 1])
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <!-- End Scrollable Comments -->

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
function toggleReplyForm(commentId){
    var form = document.getElementById('reply-form-' + commentId);
    if(form.style.display === "none" || form.style.display === ""){
        form.style.display = "block";
        form.querySelector('input[name="content"]').focus();
    } else {
        form.style.display = "none";
    }
}
</script>

@endsection
