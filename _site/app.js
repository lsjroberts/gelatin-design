var connect = require('connect');
connect.createServer(connect.static(__dirname + '/_site')).listen(3001);
console.log('Started on port 3001...');