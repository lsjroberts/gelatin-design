$(function() {
	var gamepad = new Gamepad();
	gamepad.deadzone = 0.2;

	var playgame = new PlayGame();

	var axes_min_buffer = 0.2;
	var speed_multiplier = 10;

	gamepad.bind(Gamepad.Event.CONNECTED, function(device) {
		console.log('Connected', device);
		playgame.addPlayer($('#player'));
	});

	gamepad.bind(Gamepad.Event.DISCONNECTED, function(device) {
		console.log('Disconnected', device);
	});

	gamepad.bind(Gamepad.Event.UNSUPPORTED, function(device) {
		console.log('Unsupported controller connected', device);
	});

	gamepad.bind(Gamepad.Event.TICK, function(gamepads) {
		var control, value, i = 0;

		var speed_x = 0, speed_y = 0;

		//for (i = 0; i < gamepads.length; i++) {
			for (control in gamepads[i].state) {
				value = gamepads[i].state[control];

				switch (control) {
					case 'LEFT_STICK_X':
						playgame.players[i].moveX(value);
						break;

					case 'LEFT_STICK_Y':
						
						break;

					case 'A':
						if (value > 0) {
							playgame.players[i].jump();
						}
						break;
				}
			}
		//}
		
		playgame.tick();
	});

	if (!gamepad.init()) {
		console.log('Gamepad API not supported');
	}

	playgame.init();
});