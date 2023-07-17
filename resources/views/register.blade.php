<form action="{{ route('user.store') }}" method="POST">
    @csrf
    <input type="text" name="nama" placeholder="Nama" required>
    <input type="text" name="alamat" placeholder="Alamat" required>
    <input type="text" name="nomor_telepon" placeholder="Nomor Telepon" required>
    <input type="text" name="nomor_sim" placeholder="Nomor SIM" required>
    <button type="submit">Daftar</button>
</form>