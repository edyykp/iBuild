// socket for the front end
var socket = io.connect("http://localhost:4000");

var   send_button = document.getElementById('send_message'),
      chat_text = document.getElementById('chat_text'),
      message = document.getElementById('message'),
      acknowledgement = document.getElementById('acknowledgement');

// Emit events to the server
// Vanilla javascript for listening for events
// objects to be emitted are placed inside curly brackets {}
send_button.addEventListener('click', function(){
    var name = document.getElementById('sender_name'),
        sender = document.getElementById('sender_id'),
        receiver = document.getElementById('sender_id');
    if(message.value !== "") {
        socket.emit('msg', {
            message: message.value,
            sender: sender.value,
            name: name.value,
            receiver: receiver.value
        });
    }
    // once the mesage has been emitted to the server, the message area is an
    // empty string.
    message.value = "";
});

// Listening for events back from the server
// Once the message has been recieved by the server and sent back to all the
// clients ~ the acknowledgement is an empty string.
// Concatenating the message to the chat_text.
socket.on('new_msg', function(data){
    chat_text.innerHTML += '<p><strong>' + data.name + ': </strong>' + data.message + '</p>';
});

// Listening to a keypress event i.e. when the sender is typing a message.
message.addEventListener('keypress', function(){
    var name = document.getElementById('sender_name'),
        sender = document.getElementById('sender_id'),
        receiver = document.getElementById('sender_id');

    socket.emit('typing', {
        sender: sender.value,
        press: true,
        name: name.value,
        receiver: receiver.value
    });
});

message.addEventListener('keyup',function(){
    var name = document.getElementById('sender_name'),
        sender = document.getElementById('sender_id'),
        receiver = document.getElementById('sender_id');

    setTimeout(function() {
        socket.emit('typing', {
        name: name.value,
        sender: sender.value,
        press: false,
        receiver: receiver.value
    });
    },1000);
});
// Displaying the output when the acknowledgement is brodcasted from the server
socket.on('typing', function(data){
    if( data.press === true) {
        acknowledgement.innerHTML = '<p><em>' + data.name + ' is typing .....</em></p>';
    }
    else {
        acknowledgement.innerHTML = "";
    }
});
