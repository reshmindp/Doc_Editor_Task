@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Document</h2>

    <h5>Currently Editing:</h5>
    <ul id="user-list" class="list-group"></ul>
    <textarea id="editor" class="form-control" rows="10">{!! $document->content !!}</textarea>
    <button class="btn btn-success mt-3" onclick="saveDocument()">Save</button>
</div>

<script>
    window.documentId = "{{ $document->id }}";
</script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
{{-- @vite('resources/js/app.js') --}}
<script>
     
    Pusher.logToConsole = true;

    const documentId = "{{ $document->id }}";
    const editor = document.getElementById("editor");
    const userList = document.getElementById("user-list");

    // const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
    //     cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
    //     forceTLS: true
    // });

    const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
        cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
        forceTLS: true,
        authEndpoint: "/broadcasting/auth", 
        auth: {
            headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",  
            "Authorization": "Bearer {{ auth()->user()->api_token ?? '' }}"  
        }
        }
    });

    const presenceChannel = pusher.subscribe(`presence-document.${documentId}`);

    // When a user joins
    presenceChannel.bind("pusher:subscription_succeeded", function(members) {
        updateUserList(members);
    });

    // When a new user joins
    presenceChannel.bind("pusher:member_added", function(member) {
        updateUserList(presenceChannel.members);
    });

    // When a user leaves
    presenceChannel.bind("pusher:member_removed", function(member) {
        updateUserList(presenceChannel.members);
    });

    function updateUserList(members) {
        userList.innerHTML = ""; // Clear the list
        members.each((member) => {
            const li = document.createElement("li");
            li.classList.add("list-group-item");
            li.textContent = member.info.name;
            userList.appendChild(li);
        });
    }

    const channel = pusher.subscribe(`document.${documentId}`);
    channel.bind("document.updated", function(data) {
        console.log("Received update:", data.content);
        $('#editor').summernote('code', data.content);
    });

    pusher.connection.bind('connected', function() {
    console.log('Pusher connected');
    });
    pusher.connection.bind('error', function(err) {
        console.error('Pusher error:', err);
    });

    function saveDocument() {
        fetch("{{ route('documents.update', $document) }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "X-HTTP-Method-Override": "PUT"
            },
            body: JSON.stringify({ content: editor.value })
        }).then(response => response.json())
        .then(data => console.log(data.message));
    }

    editor.addEventListener("focus", function() {
        fetch(`/document/${documentId}/editing`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        });
    });


</script>
<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
<script>
     
    $(document).ready(function() {
      $('#editor').summernote({
        height: 300,  
        placeholder: 'Type your text here...',
      });
    });
</script>

@endsection