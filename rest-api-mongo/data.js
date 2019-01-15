const fetch = require('node-fetch');


var url = 'http://tesaapi.phath.am/api/temperature/1';
fetch(url).then(
        function(u){ return u.json();}
      ).then(
        function(json){
          jsondata = json;
          console.log(jsondata);

        }
      )

      const mongoose = require('mongoose');
      mongoose.connect('mongodb://localhost/test');
      const db = mongoose.connection;
      db.on('error', console.error.bind(console, 'connection error:'));
      db.once('open', function() {
        console.log('Opened');
      });
      const sensorSchema = new mongoose.Schema({
        place: String,
        timestamp: Date,
        value: Number
      });
      const Sensor = mongoose.model('Sensor', sensorSchema);

      const express = require('express');
      const bodyParser = require('body-parser');
      const app = express();
      const port = 3000;
      app.use(bodyParser.json());
      app.get('/', (req, res) => res.send('curl -X POST -d &apos;{"place": "home", "value": 10}&apos; -H "Content-Type: application/json" http://localhost:3000/add'));
      app.post('/add', function(req, res) {
        var ans = {status : 'OK'};
        var place = req.body.place;
        var value = parseInt(req.body.value);
        if ((place == undefined) || isNaN(value)) {
          ans = {status : 'ERR'};
        } else {
          var timestamp = new Date;
          var sensorObj = new Sensor({place : place, timestamp : timestamp, value : value});
          sensorObj.save(function (err, obj) {
            if (err) {
              ans = {status : 'ERR'};
              return console.error(err);
            }
            console.log(obj);
          });
        }
        res.json(ans);
      });
      app.listen(port, () => console.log(`Example app listening on port ${port}!`));
