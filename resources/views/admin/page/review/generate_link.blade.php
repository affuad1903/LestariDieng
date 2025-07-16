@extends('admin.layouts.master')

@section('title') Generate Link Review @endsection

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title">Generate Link Review</h4>

                <form action="{{ route('review.generate-link') }}" method="GET" class="row g-3">
                    <div class="col-12">
                        <label for="paket_id" class="form-label">Pilih Paket Wisata</label>
                        <select name="paket_id" id="paket_id" class="form-select">
                            <option value="">-- Pilih Paket --</option>
                            @foreach($pakets as $paket)
                                <option value="{{ $paket->id }}" {{ request('paket_id') == $paket->id ? 'selected' : '' }}>
                                    {{ $paket->paket_title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Generate Link
                        </button>
                    </div>
                </form>

                @if($generatedLink)
                    <div class="mt-4">
                        <label class="form-label">Link Review:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="reviewLink" value="{{ $generatedLink }}" readonly>
                            <button class="btn btn-outline-secondary" type="button" onclick="copyLink()">Copy</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function copyLink() {
    const copyText = document.getElementById("reviewLink");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    alert("Link disalin: " + copyText.value);
}
</script>
@endsection
