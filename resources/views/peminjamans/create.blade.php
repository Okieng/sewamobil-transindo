<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create New Post - Tutorial CRUD Laravel 8 @ qadrlabs.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- include summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">

                <!-- Notifikasi menggunakan flash session data -->
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
                @endif

                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                    <h1>Pesan Mobil</h1>
                        <form action="{{ route('peminjaman.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                            <label for="mobil_id">Pilih Mobil:</label>
                                <select class="form-control" name="mobil_id" id="mobil_id" required>
                                    @foreach($mobils as $mobil)
                                        <option value="{{ $mobil->id }}">{{ $mobil->merk }} - {{ $mobil->model }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_mulai" class="form-control">Tanggal Mulai:</label>
                                <input class="form-control" type="date" name="tanggal_mulai" id="tanggal_mulai" required>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_selesai" class="form-control">Tanggal Selesai:</label>
                                <input class="form-control" type="date" name="tanggal_selesai" id="tanggal_selesai" required>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary">Pesan Mobil</button>
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-md btn-secondary">back</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- include summernote js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 250, //set editable area's height
            });
        })
    </script>
</body>

</html>

