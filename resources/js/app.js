import Pusher from 'pusher-js';
import axios from 'axios';

const documentId = window.documentId;
const editor = document.getElementById("editor");
const userList = document.getElementById("user-list");

Pusher.logToConsole = true;

const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
    cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
    forceTLS: true
});

 
const channel = pusher.subscribe(`document.${documentId}`);
channel.bind("document.updated", function (data) {
    console.log("Received update:", data);
    if (data.content) {
        editor.innerHTML = data.content;  
    }
});

pusher.connection.bind('connected', function() {
    console.log('Pusher connected');
});
pusher.connection.bind('error', function(err) {
    console.error('Pusher error:', err);
});

const presenceChannel = pusher.subscribe(`presence-document.${documentId}`);

presenceChannel.bind("pusher:subscription_succeeded", (members) => {
    updateUserList(members);
});

presenceChannel.bind("pusher:member_added", (member) => {
    updateUserList(presenceChannel.members);
});

presenceChannel.bind("pusher:member_removed", (member) => {
    updateUserList(presenceChannel.members);
});

function updateUserList(members) {
    let userListText = Object.values(members.members)
        .map((user) => user.name)
        .join(", ");
    userList.innerHTML = userListText || "No active users";
}

document.getElementById("editor").addEventListener("input", async function () {
    await axios.put(`/api/documents/${documentId}`, { content: editor.value });
});