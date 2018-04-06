var WebSocket = require('ws');
var redis = require('redis'),
    subscriber = redis.createClient();


var wss = new WebSocket.Server({

    port: 8080

});

wss.broadcast = (data) => {
    wss.clients.forEach((client) => {
        if (client.readyState === WebSocket.OPEN) {
            client.send(data);
        }
    });
}

subscriber.on('message', function (channel, message) {
    console.log('berichtje, gaan we versturen');
    wss.broadcast(message);
});

subscriber.subscribe('websocket');
