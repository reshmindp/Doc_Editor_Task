@extends('layouts.app')

@section('content')

<script>
    function confirmDelete(event, form) {
       event.preventDefault();

       if (confirm("Are you sure you want to delete the document?")) {
           form.submit();
       }
   }
</script> 

<div class="container">
    <h2>Dashboard</h2>
    <p>Welcome, {{ auth()->user()->name }}!</p>

    <a href="{{ route('documents.create') }}" class="btn btn-primary mb-3">Create New Document</a>

    <h3>My Documents</h3>
    @if (!$documents)
        <p>No documents found. Start by creating a new one.</p>
    @else
        <ul class="list-group">
            @foreach ($documents as $document)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('documents.edit', $document->id) }}">{{ $document->title }}</a>
                    <div>
                        <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('documents.destroy', $document->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="confirmDelete(event, this.closest('form'))" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection