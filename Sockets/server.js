// This file is a server created on node js

var express = require('express');  // create an express app on node
var app = express();               // to setup the app

// a server is created which makes use of an express app
var server = require('http').createServer(app);


// process.env.PORT will allow the server be able to accept a parameter
// for what port to listen to, otherwise it will look for port 4000 by default.
server.listen(4000| process.env.PORT);
console.log('server running...');

/*db.connect(function(err){
    if (err) console.log(err)
});*/
// Socket setup
// a library socket.io is used to make use of websockets
var socket = require("socket.io");

// the parameter in the function socket() is the server we will be using
// Socket setup & pass server
var io = socket(server);

// file_system module for node js - to work with files
var file_system = require('fs');

//Static files
// this will serve the files from the folder named 'chat_files' to the browser
app.use(express.static('chat_files'));

// arrays initialized: one for the users and one for the number of connections
//users = [];
number_of_connections = [];
var connectedUsers = {};

// Creating a connection with socket io
io.on('connection', function(socket){
    number_of_connections.push(socket);
    console.log('%s sockets are connected', number_of_connections.length);
    console.log('socket', socket.id, 'made a connection');
   // connectedUsers[id] = socket.id;
    socket.on('submit', function(data){
       connectedUsers[data] = socket.id;
       console.log(data);
    });
    //Accessing past chat
    content = file_system.readFileSync("ManyaBobi2020chat.json");   // ** add error handling function for this.
    var past_chat = JSON.parse(content);   //string is parsed i.e. converted a JavaScript object
    for(let i = 0; i<(past_chat.texts.length); i++){
      io.sockets.emit('new_msg', past_chat.texts[i]);
    }

    // Disconnect
    // splice method returns the removed items in an array
    // index shows at what position to remove items from the array
    socket.on('disconnect', function(data){
        number_of_connections.splice(number_of_connections.indexOf(socket), 1);
        console.log('%s sockets are connected', number_of_connections.length);
     //   delete connectedUsers[id];
    });

    // Sending messages
    // the messages received by the server is sent to all the clients connected
    // using io.sockets.emit (this also includes the client who sent the message
    // in the first place).
    socket.on('msg', function(data){
        //var d = new Date();
        //var query = "INSERT INTO Messages (sent_from, sent_to, message_text, date_time) VALUES (?)";
        //var values = [parseInt(data.sender), parseInt(data.receiver), data.message, d.timeNow()]

        io.sockets.sockets[connectedUsers[data.receiver]].emit('new_msg', data);
        io.sockets.sockets[connectedUsers[data.sender]].emit('new_msg', data);

      //  db.query(query, [values], function (err) {
        //    if (err) throw err;
          //  console.log("1 record inserted");
        //});
    });

    // As soon as a message is received by a client, it is also appended
    // to the chat_file.txt
    socket.on('msg', function(data){
        var content = file_system.readFileSync("ManyaBobi2020chat.json");   // ** add error handling function for this.
        var chat_array = JSON.parse(content);
        chat_array.texts.push(data);
        file_system.writeFileSync("ManyaBobi2020chat.json", JSON.stringify(chat_array), 'utf-8', function (err) {
           if (err) throw err;
           console.log('File updated!');
        });
    });

    // Typing event when a sender is typing
    // broadcast is used to send this data to all the clients connected to
    // the server, other than the client who originally emitted this data i.e.
    // the one who is typing.
    socket.on('typing', function(data){
        io.sockets.sockets[connectedUsers[data.receiver]].emit('typing', data);
    });

});

// For the time now
/*Date.prototype.timeNow = function () {
    return ((this.getHours() < 10)?"0":"") + this.getHours() +":"+ ((this.getMinutes() < 10)?"0":"") + this.getMinutes();
};*/
