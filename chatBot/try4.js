// Import Library
const bodyParser = require('body-parser') // parse json, so we can call node and object
const request = require('request')// networking to curl outside
const express = require('express')// wrapper we can write node js shorter
var mongojs = require('./db');
const fetch = require('node-fetch');
const app = express()

const port = process.env.PORT || 4000
const hostname = '127.0.0.1'
const HEADERS = {
	'Content-Type': 'application/json',
	'Authorization': 'Bearer 7FtTOEeJqVyNq1TwHhQvANXqbVEY1nSGr98D8+4dQH22ccQD5dsL7TizVxUzk/TRahfAjbqwBdJ8rdEITRoI67mOOAKZWOcmaKrOkOyOBVPZkMhvtp1PcJtS2k4WooKWlWchgro7pDOyglWtLuR4QwdB04t89/1O/w1cDnyilFU='
}
var db = mongojs.connect;
const mongoose = require ('mongoose');
mongoose.connect('mongodb://localhost/line');
const db2 = mongoose.connection;
db2.on('error', console.error.bind(console, 'connection error:'));
db2.once('open', function() {
  console.log('Opened');
});
const beaconSchema = new mongoose.Schema({
	userID: String,
	status: String,
  timestamp:Number,
  date: String,
  time: String

});

const timerSchema = new mongoose.Schema({
  user_id: String,
  timestamp:Number,
  date: String,
  time: String,
  status: String
});


const Beacon = mongoose.model('beacon', beaconSchema);
const Timer = mongoose.model('timer', timerSchema);

var arry =[];

var url = 'http://202.139.192.94:4000/current';

app.use(bodyParser.urlencoded({ extended: false }))//initiate body parser to get json
app.use(bodyParser.json())



// Push
//get method
app.get('/webhook', (req, res) => {
	// push block
	let msg ='Hello TESA'
	push(msg)
	res.send(msg)
})

// Reply
//post method
app.post('/webhook', (req, res) => {
	// reply block
	console.log(req.body.events[0])
	let type = req.body.events[0].type
	let reply_token = req.body.events[0].replyToken

	if (type === 'message'){
		let msg = req.body.events[0].message.text
		let info = JSON.stringify(req.body.events[0])
		//console.log('get in?')
		//console.log('incoming: '+msg)
		if(req.body.events[0].message.type  ==='sticker'){
			console.log('incomming sticker');
			reply(reply_token,"Wow, Nice sticker!")
		}

		if (msg==='Admin_Mon'){
			fetch(url).then(
        function(u){ return u.json();}
      ).then(
        function(json){
          var jsondata = JSON.stringify(json);
					var message='Temperature: '+json.temperature+" \nHumidity:"+json.humidity;

					reply(reply_token,message)

        }
      )
			//reply(reply_token,'Sleep')
		}
		else{
		reply(reply_token,msg)
		}
		//reply(reply_token,info)
		console.log(info)
		console.log('Type:' +type)
	}
	else if (type==='beacon') {
		console.log('incoming beacon');
		var timestamp = Date.now();
  	var date = new Date();
  	var hours = date.getHours();
  	var minutes = "0" + date.getMinutes();
  	var seconds = "0" + date.getSeconds();
  	var formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
  	var formattedDate = date.toLocaleDateString()
		//reply(reply_token,""+JSON.stringify(info))
		let info = JSON.stringify(req.body.events[0])
		//ENTER
		if (req.body.events[0].beacon.type==='enter')
		{
						reply(reply_token,"You are getting close to Bunny :)")
						var task ={
							userID: req.body.events[0].source.userId,
							status: 'enter',
							timestamp: timestamp,
			    		date: formattedDate,
			    		time: formattedTime
						}
						db.beacon.insert(task, function (err, docs) {
							console.log(docs);
							res.send(docs);
						});
					}

		//LEAVE
		else if(req.body.events[0].beacon.type==='leave')
		{
			reply(reply_token,"You are leaving Bunny :(")
			var out ={
	//teamID: 11,
		userID: req.body.events[0].source.userId,
		status: 'leave',
		timestamp: timestamp,
    date: formattedDate,
    time: formattedTime

			}
			db.beacon.insert(out, function (err, docs) {
				console.log(docs);
				res.send(docs);
			});


		}

		// let info = JSON.stringify(req.body.events[0])
		// reply(reply_token,info)

	}

})

function push(msg) {
	let body = JSON.stringify({ //change into json string
    // push body
		to:'U567bed15681d01dcf1674d64762da4e3',
		messages:[
			{
				type: 'text',
				text: msg
			}
		]
  })
  // curl
	curl('push',body)
}

function reply(reply_token, msg) {
	let body = JSON.stringify({
    // reply body
		replyToken:reply_token,
		messages:[
			{
				type: 'text',
				text: msg
			}
		]
  })
  // curl
	curl('reply', body)
}

//body neeed to be JSON//method: reply,push
function curl(method, body) {
	request.post({
		url: 'https://api.line.me/v2/bot/message/' + method,
		headers: HEADERS,
		body: body
	}, (err, res, body) => {
		console.log('status = ' + res.statusCode)
	})
}

app.listen(port, hostname, () => {
	console.log(`Server running at http://${hostname}:${port}/`)
})
