var {VM} = require('vm2');
var redis = require('redis'),
    client = redis.createClient();

client.get('payload', (err, data) => { 
    var payload = JSON.parse(data);
    console.log(payload);
    var error;

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
        console.log(vm._context)
    } else {
        console.log(error);
    }

});

client.quit();
