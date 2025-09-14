<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TranslatorController extends Controller
{
    public function index()
    {
        return view('translator');
    }

    public function translate(Request $request)
    {
        $text = $request->input('text');
        $from = $request->input('from');
        $to = $request->input('to');

        // Dummy translation logic
        $translated = $this->regionalTranslate($text, $to);

        return view('translator', compact('text', 'from', 'to', 'translated'));
    }

    private function regionalTranslate($text, $region)
    {
        // Example dummy translations
        $dictionary = [
            'hello' => [
                'barisal' => 'হেই রে',
                'raj' => 'হেই',
                'ctg'     => 'হালা',
                'noakhali'=> 'হেই তুই',
                'bn'      => 'হ্যালো',
            ],
            'how are you' => [
                'barisal' => 'কেমনে আছস',
                'ctg'     => 'তুই কেমন আছস হালা',
                'noakhali'=> 'কেমন আছসরে তুই',
                'bn'      => 'তুমি কেমন আছো',
                'raj'      => 'আপনি কেমন আছেন',
            ],
            'water' => [
                'barisal' => 'Hani',
                'ctg'     => 'তুই কেমন আছস হালা',
                'noakhali'=> 'হানি',
                'bn'      => 'তুমি কেমন আছো',
                'raj'      => 'পানি',
            ],
            'পানি' => [
                'barisal' => 'Hani',
                'ctg'     => 'তুই কেমন আছস হালা',
                'noakhali'=> 'হানি',
                'bn'      => 'তুমি কেমন আছো',
                'raj'      => 'পানি',
            ],
        ];

        $text = strtolower(trim($text));
        return $dictionary[$text][$region] ?? 'অনুবাদ পাওয়া যায়নি';
    }
}
