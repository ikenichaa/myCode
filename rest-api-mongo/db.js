var mongojs = require('mongojs');

var databaseUrl = 'mongodb://localhost/newnew';

var collections = ['Sensor'];

var connect = mongojs(databaseUrl, collections);

module.exports = {
    connect: connect
};
