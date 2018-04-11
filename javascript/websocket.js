var WebSocket = require('ws');
var redis = require('redis'),
    publisher = redis.createClient();
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

server.on('connection', (connection, request) => {
    console.log('connection received from ' + request.connection.remoteAddress);
    connection.on('message', (message) => {
        publisher.publish('websocket-in', message);
    });

});

subscriber.on('message', function (channel, message) {
    server.broadcast(message);
});

subscriber.subscribe('websocket-out');
