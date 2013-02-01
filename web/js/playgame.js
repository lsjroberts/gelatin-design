PlayGame = function() {
	this.players = [];
	this.gravity = 0.4;
	this.terminalVelocity = 30;
	this.gravityOn = true;
};

PlayGame.prototype.init = function() {

};

PlayGame.prototype.addPlayer = function(el) {
	player = new PlayGamePlayer();
	player.el = el;
	this.players.push(player);
};

PlayGame.prototype.update = function() {
	if (this.gravityOn) {
		for (p in this.players) {
			this.players[p].update(this);
		}
	}
};

PlayGame.prototype.draw = function() {
	for (p in this.players) {
		this.players[p].draw();
	}
};

PlayGame.prototype.tick = function() {
	this.update();
	this.draw();
};


PlayGamePlayer = function() {
	this.x = 0;
	this.y = 0;
	this.xChange = 0;
	this.yChange = 0;
	this.speed = 5;
	this.jumpStrength = 5;
	this.jumpCount = 0;
	this.maxJumpCount = 2;
	this.gamepad = null;
	this.el = null;
};

PlayGamePlayer.prototype.moveX = function(value) {
	this.xChange = value * this.speed;
};

PlayGamePlayer.prototype.jump = function() {
	if (this.yChange >= 0) {
		this.jumpCount = 0;
	}

	if (this.jumpCount < this.maxJumpCount) {
		this.jumpCount++;
		this.yChange = -this.jumpStrength;
	}
};

PlayGamePlayer.prototype.update = function(game) {
	var player = this;
	player.yChange += game.gravity;
	if (player.yChange > game.terminalVelocity) {
		player.yChange = game.terminalVelocity;
	}
};

PlayGamePlayer.prototype.draw = function() {
	var player = this;
	
	player.el.css('left', function(i, v) {
		return (parseFloat(v) + player.xChange) + 'px';
	});

	player.el.css('top', function(i, v) {
		return (parseFloat(v) + player.yChange) + 'px';
	});
};