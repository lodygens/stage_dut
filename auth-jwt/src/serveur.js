var http = require('http');
var express = require("express");
var bodyparser = require("body-parser");
var jwt = require("jsonwebtoken");
var expressJwt = require("express-jwt");

var app = express();
var server = http.createServer(app);

var mySecret = "Imesety";

app.use(bodyparser.urlencoded({extended:false}));

//app.use(expressJwt({ secret: mySecret }).unless({ path: [ '/' ]}));
app.get("/", function(req, res){
	res.setHeader('Content-Type', "text/html");
	res.sendFile("./connexion.html", {root: __dirname });
});

app.post('/access', function(req, res){
	if(!req.body || req.body.login !== 'admin' || req.body.pwd !== 'admin'){
		res.statusCode = 401;
   	 	res.setHeader('Content-Type','Acces denied');
    	res.end('Access denied');
    }else{
		res.statusCode = 200;
		res.setHeader('Content-Type', "text/html");
		var token= jwt.sign({ id : 'toto', name : 'yolo', date : 'tomorrow' }, mySecret);
		console.log(token);
		res.cookie('token',token);
		res.sendFile("./access.php", {root: __dirname });
		
	}
	
});

server.listen(8080);

//res.setHeader('Content-Type', "text/html");
//res.sendFile("./index.html", {root: __dirname });
