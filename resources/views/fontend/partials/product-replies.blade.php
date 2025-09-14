@foreach($replies as $reply)
    <div class="reply mb-1" style="margin-left:{{ $level * 20 }}px; border-left:1px dashed #ccc; padding-left:5px;">
        <strong>{{ $reply->customer->name ?? 'Guest' }}</strong>: {{ $reply->content }}

        <!-- Reply Form -->
        <form action="{{ route('product.comment.reply', $reply->id) }}" method="POST" class="mt-1">
            @csrf
            <input type="hidden" name="product_id" value="{{ $reply->product_id }}">
            <input type="text" name="content" class="form-control form-control-sm mb-1" placeholder="Reply...">
            <button type="submit" class="btn btn-sm btn-secondary">Reply</button>
        </form>

        <!-- Nested replies -->
        @if($reply->replies->count())
            @include('fontend.partials.product-replies', ['replies' => $reply->replies, 'level' => $level + 1])
        @endif
    </div>
@endforeach
