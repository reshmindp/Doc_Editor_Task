@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create a New Document</h2>
    <form action="{{ route('documents.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection