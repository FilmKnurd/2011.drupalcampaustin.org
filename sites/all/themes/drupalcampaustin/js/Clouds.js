
var Cloud = function(opts) {
  this.init(opts);
};

Cloud.prototype = {

  init: function(opts) {
    var self = this;
    
    this.image = new Image();
    this.image.src = Math.round(Math.random() * 2)
      ? "/sites/all/themes/drupalcampaustin/images/cloud-left.png"
      : "/sites/all/themes/drupalcampaustin/images/cloud-right.png";
    
    this.image.onload = function() {
      self.width = Math.round(self.image.width * Math.random());
      self.height = Math.round(self.width * (self.image.height / self.image.width));
      
      self.rate = Math.ceil(self.height * .3 / 10);
    };
    
    this.rate = Math.round(Math.random() + 1 * 4);
    this.x = 0;
    this.y = 0;
  }
  
};
