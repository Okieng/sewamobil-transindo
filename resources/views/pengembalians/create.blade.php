<form action="{{ route('pengembalians.store') }}" method="POST">
    @csrf
    <input type="text" name="no_plat" placeholder="Nomor Plat" required>
    <button type="submit">Kembalikan Mobil</button>
</form>