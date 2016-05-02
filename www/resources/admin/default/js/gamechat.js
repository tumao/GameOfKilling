var conn = new WebSocket ('ws:192.168.31.11:9979');
conn.onopen = function (e){
	console.log ('connection established!');
};

conn.onMessage = function (e){
	console.log (e.data);
};