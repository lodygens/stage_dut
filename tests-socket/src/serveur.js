var http = require('http');
var fs = require('fs');

// Chargement du fichier index.html affiché au client
var server = http.createServer(function(req, res) {
	fs.readFile('./index.html', 'utf-8', function(error, content) {
		res.writeHead(200, {"Content-Type": "text/html"});
		res.end(content);
	});
});

// Chargement de socket.io
var io = require('socket.io').listen(server);

// Quand un client se connecte, on le note dans la console
io.sockets.on('connection', function (socket) {
	//Connexion d'un client
	socket.on('petit_nouveau', function(pseudo) {
    	//On récupère le pseudo
    	socket.pseudo = pseudo;
    	//Affiche dans la console
    	console.log("Nouveau client : " + socket.pseudo);
    	//Indique la connexion aux clients
    	socket.broadcast.emit('connexion', socket.pseudo + " vient de se connecter.");
    	// Et on lui indique que c'est ok
		socket.emit('signal_ok', 'Vous êtes bien connecté !');
	});
	
	
	//Reception des messages
	socket.on('text', function (text) {
		socket.text = text
		console.log(socket.text);
		socket.broadcast.emit('text', socket.text);
		socket.emit('text', socket.text);
	}); 

});









server.listen(8080);
