@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Documents</h2>
    <a href="{{ route('documents.create') }}" class="btn btn-primary mb-3">New Document</a>
    <ul class="list-group">
        @foreach ($documents as $document)
            <li class="list-group-item d-flex justify-content-between">
                <a href="{{ route('documents.edit', $document) }}">{{ $document->title }}</a>
                <form action="{{ route('documents.destroy', $document) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection