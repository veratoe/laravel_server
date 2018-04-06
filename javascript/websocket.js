var WebSocket = require('ws');
var redis = require('redis'),
    subscriber = redis.createClient();

const port = 8090;

var server = new WebSocket.Server({
    port: port
});

console.log('Started websocket server on port ' + port);

server.broadcast = (data) => {
    server.clients.forEach((client) => {
        if (client.readyState === WebSocket.OPEN) {
            client.send(data);
        }
    });
}

server.on('connection', (request) => { console.log('Incoming connection') });

subscriber.on('message', function (channel, message) {
    console.log('berichtje, gaan we versturen');
    console.log(message);
    server.broadcast(message);
});

subscriber.subscribe('websocket');
