<div class="container">
    <h2>Edit Article</h2>
    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="{{ $article->title }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" id="content" class="form-control">{{ $article->content }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="published" {{ $article->status === 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ $article->status === 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Update Article</button>
    </form>
</div>
