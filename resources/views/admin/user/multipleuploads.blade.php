@extends('layouts.admin.app')

@section('content')

<div class="card">
    <div class="card-body">

        {{-- ====== FORM UPLOAD ====== --}}
        <h5 class="mb-3">Upload File or Images</h5>

        <form action="{{ url('/save') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">File</label>
                <input type="file" name="files[]" class="form-control" multiple required>
            </div>

            <button type="submit" class="btn btn-primary">Upload</button>
        </form>


        {{-- ====== HASIL UPLOAD ====== --}}
        @if(session('success'))
            <div class="mt-4">
                <p><strong>Success</strong></p>

                {{-- Tampilkan gambar atau file yang diupload --}}
                @if(session('uploadedFiles'))
                    @foreach(session('uploadedFiles') as $file)
                        <div class="mb-3">
                            <img src="{{ asset('storage/uploads/' . $file) }}"
                                 alt="Uploaded Image"
                                 style="max-width: 100%; border: 1px solid #ccc;">
                        </div>
                    @endforeach
                @endif
            </div>
        @endif

    </div>
</div>

@endsection
    