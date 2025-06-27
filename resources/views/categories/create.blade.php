<h2>Tambah Kategori</h2>
<form method="POST" action="{{ route('categories.store') }}">
    @csrf
    <label>Nama:</label>
    <input type="text" name="name" required>
    
    <label>Status Aktif:</label>
    <select name="is_active">
        <option value="1">Aktif</option>
        <option value="0">Nonaktif</option>
    </select>

    <button type="submit">Simpan</button>
</form>