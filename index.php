<html>
<head>

</head>

<body>
<h1>Web Sockets!</h1>

<form action="" name="messages">
	<div class="row">Name: <input type="text" name="fname"/></div>
	<div class="row">Text: <input type="text" name="msg"/></div>
	<div class="row"><input type="submit" value="go!"/></div>
</form>
<div id="status"></div>

<script>
	window.omload = function(){
		var socket = new WebSocket('ws://echo.websocket.org');
		var status = document.querySelector('#status');
		socket.onopen = function(event){
			
				status.innerHTML = 'connected';
			
			
		};
		socket.onclose = function(event){
			if( event.wasClean ){
			status.innerHTML = 'closed';
			}else{
				status.innerHTML = 'closed some';
			}
		};
		socket.onmessage = function(event){
			status.innerHTML = 'message: ' + event.data;
			let mess = JSON.parse(event.data);
			status.innerHTML = `name: ${mess.name}, mess: ${mess.msg}`;
		};
		socket.onerror = function(event){
			status.innerHTML = 'error^(' + event.message;
		};
		document.forms['messages'].onsubmit = function(){

			let message = {
				name: this.fname.value,
				msg: this.msg.value
			}

			socket.send(JSON.stringify(message));
			return false;
		}
		//return false;
	};
	
</script>
</body>
</html>