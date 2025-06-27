<h2>Edit Kategori</h2>
<form method="POST" action="{{ route('categories.update', $category->id) }}">
    @csrf
    @method('PUT')
    <label>Nama:</label>
    <input type="text" name="name" value="{{ $category->name }}" required>
    
    <label>Status Aktif:</label>
    <select name="is_active">
        <option value="1" @selected($category->is_active)>Aktif</option>
        <option value="0" @selected(!$category->is_active)>Nonaktif</option>
    </select>

    <button type="submit">Update</button>
</form>