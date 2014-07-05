var connect = require('connect');
connect.createServer(connect.static(__dirname + '/public')).listen(3001);
console.log('Started on port 3001...');