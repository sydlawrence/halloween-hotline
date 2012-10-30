     var numbers = [];
     
     randomNumber = function() {
      if (numbers.length === 0)
        alert("No numbers have text in yet...");
     
     
      var rand = parseInt(Math.random() * numbers.length);
      if (rand === numbers.length)
        rand = 0;
       return numbers[rand];
     }
     
      formatNumber = function(number) {
        return number.slice(0,number.length-2) + "XX";
      }
      
      var Fish = function(number, text) {
        
        this.x = 0;
        this.y = 0;
        this.dx = 1;
        this.dy = 1;
        
        this.speedx = 1;
        this.speedy = 1;
        
        var div = $("<div class='fish' />");
        
        var img = new Image();
        
        this.render = function() {
          img.src = "plain_ghost.png";
          img.width = 100;
          img.style.top = 0;
          img.style.left = 0;
          this.flip();
          div.append(img);
          if (text === undefined)
            text = "CALL";
          div.append("<div class='text'>"+number+": "+text+"</div>");
          $('body').append(div);
          
          div = div[0];
        }
        
        this.flip = function(flipped) {
          if (flipped === undefined) {
            $(div).addClass("flipped");
          }
          else {
            $(div).removeClass("flipped");

          }
        }
        
        this.move = function() {
          var that = this;
          this.x = this.x + (this.speedx * this.dx);
          this.y = this.y + (this.speedy * this.dy);
          div.style.top = this.y+"px";
          div.style.left = this.x+"px";
          
          var wh = $(window).height();
          var ww = $(window).width();
          
          if (this.x >= ww - img.width) {
            this.dx = -1;
            this.flip(false);
          }
          
          if (this.y >= wh - img.height) {
            this.dy = -1;
          } 
          
          if (this.x <= 0) {
            this.flip();
            this.dx = 1;
          }
          
          if (this.y <= 0) {
            this.dy = 1;
          }
          
          
          var t = setTimeout(function() {
            that.move();
          }, 20);
        }
        
        this.render();
        this.move();
        
        return this;
      }
      
      displayCaller = function(number, text) {
          var fish = new Fish(number, text);
      }
      
      
      var pusher = new Pusher('efa61030395bf0550164');
      var channel = pusher.subscribe('twilio_channel');
      channel.bind('new_call', function(data) {
        receivedCall(data);
      });
      
      channel.bind('new_sms', function(params) {
        var number = formatNumber(params.From);
        if (number !== "XX") {
          displayCaller(number, params.Body);           
        } 
      });

      receivedCall = function(params) {
        var number = formatNumber(params.From);
        if (number !== "XX") {
          displayCaller(number);           
        }      
      }