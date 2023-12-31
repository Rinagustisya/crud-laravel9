<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Post</title>
    <link rel="stylesheet" href ="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">
    <div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
        <div class="card border-8 shadow rounded">
        <div class="card-body">
            <form action="{{ route('update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-grub">
                    <label class="font-weight-bold">GAMBAR</label>
                    <input type="file" class="form-control" name="image">
                    <!-- Error mesage untuk tittle -->
                </div>
                <div class="form-grub">
                <label class="font-weight-bold">JUDUL</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror"  name="title" value="{{ old('title') }}" placeholder="Masukkan Judul Post">
               <!-- error mesegge untuk title -->
                @error('title')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                    @enderror
            </div>
            <div class="form-grub mb-3">
                <label class="font-weight-bold">KONTEN</label>
                <textarea class="form-control @error('content') is-invalid @enderror"  name="content" rows="5" placeholder="Masukkan Konten Post">{{ old('content', $post->content) }}</textarea>
                <!-- Error messege untuk content -->
                @error('content')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                    @enderror
            </div>
            <button type="submit" class="btn btn-md btn-primary">UPDATE</button> &nbsp;
            <button type="reset" class="btn btn-md btn-warning">RESET</button>
            </form>
    </div>
    </div>
        </div>
        </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>
</body>
</html>
