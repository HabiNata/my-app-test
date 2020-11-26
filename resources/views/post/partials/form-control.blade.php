<div class="form-group">

    <label for="title">Title</label>

    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $post->title }}" placeholder="Input Title">

    @error('title')

        <div class="invalid-feedback">

            {{ $message }}

        </div>

    @enderror

</div>

<div class="form-group">

    <label for="category_id">Category</label>

    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
        <option disabled selected>Please Select !</option>
        @foreach ($category as $category)

            <option {{ $category->id == $post->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }} </option>

        @endforeach
    </select>

    @error('category_id')

        <div class="invalid-feedback">

            {{ $message }}

        </div>

    @enderror

</div>

<div class="needs-validation">

    <div class="form-group">

        <label for="tag">Tag</label>

        <select name="tag[]" class="custom-select tag-select2" multiple>

            @foreach ($post->TagModels as $tags)

                <option selected value="{{ $tags->id }}">{{ $tags->name }}</option>

            @endforeach

            @foreach ($tag as $tag)

                <option value="{{ $tag->id }}">{{ $tag->name }}</option>

            @endforeach

        </select>

        @error('tag')

            <div class="invalid-feedback">

                {{ $message }}

            </div>

        @enderror

    </div>

</div>

<div class="form-group">

    <label for="body">Body</label>

    <textarea name="body" class="form-control @error('body') is-invalid @enderror">{{ old('body') ?? $post->body }}</textarea>

    @error('body')

        <div class="invalid-feedback">

            {{ $message }}

        </div>

    @enderror

</div>

<button type="submit" class="btn btn-primary">{{ $submit ?? 'Update' }}</button>
