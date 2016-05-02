var conn = new WebSocket ('ws:139.129.23.52.cn:9979');
conn.onopen = function (e){
	console.log ('connection established!');
};

conn.onMessage = function (e){
	console.log (e.data);
};