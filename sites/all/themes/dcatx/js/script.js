/* 
 * Four Kitchens
 */

//This code is for flipping the boy and girl logo in and out
var imageURLs = [
  "/sites/all/themes/dcatx/images/logo-boy.png",
  "/sites/all/themes/dcatx/images/logo-girl.png"
];
function getImageTag() {
  var img = '<img src=\"';
  var randomIndex = Math.floor(Math.random() * imageURLs.length);
  img += imageURLs[randomIndex];
  img += '\" alt=\"Some alt text\"/>';
  return img;
}



