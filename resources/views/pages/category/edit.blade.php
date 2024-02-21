@extends('layouts.app')

@section('title', 'Edit User')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Advanced Forms</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Categories</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Categories</h2>



                <div class="card">
                    <form action="{{ route('category.update', $category) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Input Text</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"
                                    class="form-control @error('name')
                                is-invalid
                            @enderror"
                                    name="name" value="{{ $category->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <input type="text"
                                    class="form-control @error('description')
                                is-invalid
                            @enderror"
                                    name="description" value="{{ $category->description }}">
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="mr-sm-2" for="category">Image</label>
                                <input type="hidden" name="oldImage" value="{{ $category->image }}">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" onchange="previewImage()" name="image" id="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                    {{-- <img src="https://picsum.photos/id/1/1200/400" class="img-fluid col-sm-6"> --}}
                                    @if($category->image)
                                        <img src="{{ asset('/storage/categories/' . $category->image) }}" class="img-preview img-fluid col-sm-5" style="max-height: 350px; overflow:hidden;">
                                    @else
                                        <img class="img-preview img-fluid col-sm-5" style="max-height: 350px; overflow:hidden;">
                                    @endif
                                    </div>
                                    @error('image')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                            </div>


                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush

<script>
    function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
