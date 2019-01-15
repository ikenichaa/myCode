var express = require('express');
var bodyParser = require('body-parser');
var mongojs = require('./db');
const fetch = require('node-fetch');

var db = mongojs.connect;
var app = express();
app.use(bodyParser.json());

const mongoose = require ('mongoose');
mongoose.connect('mongodb://localhost/newnew');
const db2 = mongoose.connection;
db2.on('error', console.error.bind(console, 'connection error:'));
db2.once('open', function() {
  console.log('Opened');
});
const sensorSchema = new mongoose.Schema({
  temperature: Number,
  humidity: Number,
  proximity: Number,
  pin: Number,
  pout: Number,
  timestamp:Number,
  date: String,
  time: String

});


const Sensor = mongoose.model('Sensor', sensorSchema);

app.get('/', function (req, res) {
  res.send("Sample Code for RESTful API");
})

// app.post('/receiveData', function (req, res) {
//   var json = req.body;
//   var teamID = parseInt(req.body.teamID);
//   //console.log(teamID);
//   var temp = parseInt(req.body.temperature);
//   var dataObj = new HwData({teamID: teamID, temp : temp});
//   console.log('Data object: '+dataObj);
//   dataObj.save(function (err, obj) {
//     if (err) {
//       ans = {status : 'ERR'};
//       return console.error(err);
//     }
//     //console.log(obj);
//
//   });
//   // db.users.insert(json, function (err, docs) {
//   //   console.log(docs);
//   //   res.send(docs);
//   });


//})

//Get all user

app.get('/showData', function (req, res) {
  //var json = req.body;
  db.Sensor.find(function (err, docs) {
    console.log(docs);
    res.send(docs);
  });

})

app.get('/current', function (req, res) {
  //var json = req.body;
  db.Sensor.find(function (err, docs) {
    var x=docs;
    console.log(x[x.length - 1]);
    res.send(x[x.length - 1]);
  });
})


//Get user by ID
// app.get('/user/:id', function (req, res) {
//   var id = parseInt(req.params.id);
//
//   db.users.findOne({
//     id: id
//   }, function (err, docs) {
//     if (docs != null) {
//       console.log('found', JSON.stringify(docs));
//       res.json(docs);
//     } else {
//       res.send('User not found');
//     }
//   });
// })

//Update user by ID in body
// app.put('/editData/:teamID', function (req, res) {
//   var id = parseInt(req.params.teamID);
//   console.log('Get from Api', req.body);
//   console.log(req.body.temperature);
//   console.log(id);
//   var e = db.temperature.count();
//   //for ()
//   db.temperature.findAndModify({
//     query: {
//       "teamID": id
//     },
//     update: {
//       $set: {"temperature": req.body.temperature},
//     },
//     new: true
//   }, function (err, docs) {
//     console.log('Update Done', docs);
//     res.json(docs);
//   });
// })
//
// app.put('/edit/:teamID', function (req, res) {
//
//   var id = parseInt(req.params.teamID);
//   console.log('Get from Api', req.body);
//   console.log(req.body.temperature);
//   console.log(id);
//   console.log(db.Temp.find());
//   db.Temp.updateMany(
//     {"teamID": id},
//     {$set: {"temperature": req.body.temperature}},
//     {multi: true},{status:true})
//     //{upsert: true});
//
//   }, function (err, docs) {
//     console.log('Update Done', docs);
//     res.json(docs);
//   });
//
//   app.put('/update/:teamID', function (req, res) {
//
//     let temp = req.body;
//         let data = {
//             'teamID': req.params.teamID,
//             'temp': temp.temperature,
//         }
//         console.log(data.temp);
//         console.log(data.teamID);
//         Temp.updateMany({teamID: data.teamID}, {$set: {temperature: data.temp}}
//         // Temp.updateMany(
//         //   {'teamID': data.teamID},
//         //   {'temperature': data.temp}
//         , (err, res) => {
//             if (err) return console.error(err);
//             else console.log(res);
//         });
//     });

//Add user
app.post('/receiveData', function (req, res) {
  var json = req.body;
  //var realJson = JSON.parse(req.body);
  console.log('all'+json);
  console.log('hi'+json.DevEUI_uplink)
  console.log('temp'+json.DevEUI_uplink.payload_parsed.frames[0].value)

  var temp = json.DevEUI_uplink.payload_parsed.frames[0].value;
  var humid = json.DevEUI_uplink.payload_parsed.frames[1].value;
  var prox = json.DevEUI_uplink.payload_parsed.frames[2].value;


  var timestamp = Date.now();
  var date = new Date();
  var hours = date.getHours();
  var minutes = "0" + date.getMinutes();
  var seconds = "0" + date.getSeconds();
  var formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
  var formattedDate = date.toLocaleDateString()
  //console.log('this is date:'+formattedDate);
  //console.log('this is time:'+typeof(date));
  //console.log('type: '+typeof(timestamp));

  var info ={
    //teamID: 11,
    temperature: temp,
    humidity:humid,
    proximity: prox,
    timestamp: timestamp,
    date: formattedDate,
    time: formattedTime

  }
  db.Sensor.insert(info, function (err, docs) {
    console.log(docs);
    res.send(docs);
  });
})

// app.post('/addData', function (req, res) {
//   var json = req.body;
//   db.temperature.insert(json, function (err, docs) {
//     console.log(docs);
//     res.send(docs);
//   });
// })
//
//
//
// //Delete user by ID
app.delete('/deleteData/:temp', function (req, res) {
  var temp = req.params.temp;
  db.Sensor.deleteMany({
    "temperature": temp
  }, function (err, docs) {
    console.log(docs);
    res.send(docs);
  });
})

var server = app.listen(8080, function () {
  var port = server.address().port

  console.log("Sample Code for RESTful API run at ", port)
})

module.exports = app;
