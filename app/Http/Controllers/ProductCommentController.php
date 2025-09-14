<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductComment;
use Illuminate\Support\Facades\Auth;

class ProductCommentController extends Controller
{
    // Store main comment
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'content'    => 'required|string|max:1000',
        ]);

        ProductComment::create([
            'product_id'  => $request->product_id,
            'customer_id' => Auth::guard('customer')->id(),  // customer guard
            'parent_id'   => null,                           // main comment
            'content'     => $request->content,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    // Store reply to a comment
    public function reply(Request $request, $commentId)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'content'    => 'required|string|max:1000',
        ]);

        ProductComment::create([
            'product_id'  => $request->product_id,
            'customer_id' => Auth::guard('customer')->id(),  // customer guard
            'parent_id'   => $commentId,                     // reply to this comment
            'content'     => $request->content,
        ]);

        return back()->with('success', 'Reply added successfully!');
    }
}
