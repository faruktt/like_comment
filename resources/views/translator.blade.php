<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>বাংলা অনুবাদক</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4 text-center">বাংলাদেশি আঞ্চলিক অনুবাদক</h2>

    <form action="{{ route('translator.translate') }}" method="POST">
        @csrf
        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label">মূল ভাষা</label>
                <select name="from" class="form-select" required>
                    <option value="" disabled {{ old('from', $from ?? '') == '' ? 'selected' : '' }}>ভাষা সনাক্ত করুন</option>
                    <option value="en" {{ old('from', $from ?? '') == 'en' ? 'selected' : '' }}>English</option>
                    <option value="bn" {{ old('from', $from ?? '') == 'bn' ? 'selected' : '' }}>বাংলা (স্ট্যান্ডার্ড)</option>
                    <option value="barisal" {{ old('from', $from ?? '') == 'barisal' ? 'selected' : '' }}>বরিশাল</option>
                    <option value="noakhali" {{ old('from', $from ?? '') == 'noakhali' ? 'selected' : '' }}>নোয়াখালী</option>
                    <option value="ctg" {{ old('from', $from ?? '') == 'ctg' ? 'selected' : '' }}>চট্টগ্রাম</option>
                    <option value="raj" {{ old('from', $from ?? '') == 'raj' ? 'selected' : '' }}>রাজশাহী</option>
                </select>

                <textarea name="text" class="form-control mt-3" rows="5" placeholder="এখানে লেখো">{{ old('text', $text ?? '') }}</textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">অনুবাদ হবে যেই ভাষায়</label>
                <select name="to" class="form-select" required>
                    <option value="" disabled {{ old('to', $to ?? '') == '' ? 'selected' : '' }}>অনুবাদের ভাষা নির্বাচন করুন</option>
                    <option value="en" {{ old('to', $to ?? '') == 'en' ? 'selected' : '' }}>English</option>
                    <option value="bn" {{ old('to', $to ?? '') == 'bn' ? 'selected' : '' }}>বাংলা (স্ট্যান্ডার্ড)</option>
                    <option value="barisal" {{ old('to', $to ?? '') == 'barisal' ? 'selected' : '' }}>বরিশাল</option>
                    <option value="noakhali" {{ old('to', $to ?? '') == 'noakhali' ? 'selected' : '' }}>নোয়াখালী</option>
                    <option value="ctg" {{ old('to', $to ?? '') == 'ctg' ? 'selected' : '' }}>চট্টগ্রাম</option>
                    <option value="raj" {{ old('to', $to ?? '') == 'raj' ? 'selected' : '' }}>রাজশাহী</option>
                </select>

                <textarea class="form-control mt-3" rows="5" readonly placeholder="অনুবাদ এখানে">{{ $translated ?? '' }}</textarea>
            </div>

        </div>

        <div class="text-center mt-3">
            <button class="btn btn-primary px-4">অনুবাদ করুন</button>
        </div>
    </form>
</div>
</body>
</html>
