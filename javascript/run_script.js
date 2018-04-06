var {VM} = require('vm2');
var redis = require('redis'),
    subscriber = redis.createClient(),
    publisher = redis.createClient();

subscriber.on('message', function (channel, message) {
    var payload = JSON.parse(message);
    var error;

    // huh?!
    if (!payload.script) 
        return;

    var vm = new VM({
        sandbox: {
            comment: payload.comment
        }
    });

    try {
        vm.run(payload.script.code);
    }
    catch(e) {
        error = e;
    }

    if (!error) {
        publisher.publish('node', JSON.stringify(vm._context));
    } else {
        console.log('Er ging iets fout!');
        console.log(error);
    }

});

subscriber.subscribe("node");
