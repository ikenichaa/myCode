// Import Library
const bodyParser = require('body-parser') // parse json, so we can call node and object
const request = require('request')// networking to curl outside
const express = require('express')// wrapper we can write node js shorter
const fetch = require('node-fetch');

const app = express()
const port = process.env.PORT || 4000
const hostname = '127.0.0.1'
const HEADERS = {
	'Content-Type': 'application/json',
	'Authorization': 'Bearer 7FtTOEeJqVyNq1TwHhQvANXqbVEY1nSGr98D8+4dQH22ccQD5dsL7TizVxUzk/TRahfAjbqwBdJ8rdEITRoI67mOOAKZWOcmaKrOkOyOBVPZkMhvtp1PcJtS2k4WooKWlWchgro7pDOyglWtLuR4QwdB04t89/1O/w1cDnyilFU='
}

app.use(bodyParser.urlencoded({ extended: false }))//initiate body parser to get json
app.use(bodyParser.json())

// Push
//get method
app.get('/hooker', (req, res) => {
	// push block
	let msg ='Hello TESA'
	push(msg)
	res.send(msg)
})
app.get('/sensor', (req, res) => {
	// push block
  fetch('http://202.139.192.94:4000/current')
      .then(res => res.text())
      .then(body => console.log(body));

  //jsn = JSON.parse(jsn)
  //res.send(`${jsn.temperature}`)

})


// Reply
//post method
app.post('/webhook', (req, res) => {
	let type = req.body.events[0].type
	let reply_token = req.body.events[0].replyToken
  let info = req.body.events[0]
	if (type === 'message'){
		if(req.body.events[0].message.type === 'text'){
			console.log('incomming text');
			let msg = req.body.events[0].message.text
			if(msg==='Admin_Mon'||'info'){ //PROBLEM 1
				var jsn = "{\"_id\":\"5c37013c546bbc084d7f5d5d\",\"temperature\":35,\"humidity\":20,\"proximity\":4,\"timestamp\":1547108668013}";
				jsn = JSON.parse(jsn)
				var message='Temperature: '+jsn.temperature+" \nHumidity:"+jsn.humidity+" \nProximity :"+jsn.proximity;
				reply(reply_token,message)
				console.log(message)
			}else{
        jj='Nice to meet you!!';
				reply(reply_token,jj)
			}
		}else if(req.body.events[0].message.type  ==='sticker'){
			console.log('incomming sticker');
			reply(reply_token,"Wow, Nice sticker!")
		}else {
		}

	}
	else if (type==='beacon') {//PROBLEM 2
		console.log('incomming beacon');
		//reply(reply_token,""+JSON.stringify(info))
		let info = JSON.stringify(req.body.events[0])
		if (req.body.events[0].beacon.type==='enter'){
			reply(reply_token,"You are closing to Bunny :)")
			//ENTER
		}else if(req.body.events[0].beacon.type==='leave'){
			reply(reply_token,"You are leaving to Bunny :(")
			//LEAVE
		}
	}else{
		reply(reply_token,info)
	}

})

app.post('/dialog', (req, res) => {
	// reply block
	console.log(req.body)
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
