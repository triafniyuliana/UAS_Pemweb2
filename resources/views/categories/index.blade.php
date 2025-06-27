<h2>Daftar Kategori</h2>
<a href="{{ route('categories.create') }}">+ Tambah Kategori</a>

<table>
    <thead>
        <tr><th>Nama</th><th>Status</th><th>Aksi</th></tr>
    </thead>
    <tbody>
        @foreach ($categories as $cat)
        <tr>
            <td>{{ $cat->name }}</td>
            <td>{{ $cat->is_active ? 'Aktif' : 'Nonaktif' }}</td>
            <td>
                <a href="{{ route('categories.edit', $cat->id) }}">Edit</a>
                <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>