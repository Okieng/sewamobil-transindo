<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
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
                        <a href="{{ route('peminjaman.create') }}" class="btn btn-md btn-success mb-3 float-right">Pesan Mobil</a>
                        @if(count($peminjamans) > 0)
                        <table class="table table-bordered mt-1">
                            <thead>
                                <tr>
                                    <th scope="col">Mobil</th>
                                    <th scope="col">Tanggal Mulai</th>
                                    <th scope="col">Tanggal Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjamans as $peminjaman)
                                    <tr>
                                        <td>{{ $peminjaman->mobil->merk }} - {{ $peminjaman->mobil->model }}</td>
                                        <td>{{ $peminjaman->tanggal_mulai }}</td>
                                        <td>{{ $peminjaman->tanggal_selesai }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <p>Tidak ada pemesanan mobil.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>

