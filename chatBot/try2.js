// Import Library
const bodyParser = require('body-parser') // parse json, so we can call node and object
const request = require('request')// networking to curl outside
const express = require('express')// wrapper we can write node js shorter

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
		//reply(reply_token,msg)
		reply(reply_token,info)
		console.log(info)
		console.log('Type:' +type)
	}
	else if (type==='beacon') {
		let info = JSON.stringify(req.body.events[0])
		reply(reply_token,info)

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
