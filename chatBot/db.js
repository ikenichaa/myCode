var mongojs = require('mongojs');

var databaseUrl = 'mongodb://localhost/line';

var collections = ['beacon'];

var connect = mongojs(databaseUrl, collections);

module.exports = {
    connect: connect
};
