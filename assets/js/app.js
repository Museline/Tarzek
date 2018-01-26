// require css
require('../css/jeu.css');

// charge jquery depuis les package le node_modules
var $ = require('jquery');

// require js
var bbcode = require('./btn_text-editor_bbcode.js');
var game = require('./jeux.js');
var jquery_back = require('./jquery.backgroundpos');
var jquery_easing = require('./jquery.easing.1.3');
var jquery_path = require('./jquery.path');

// une fois le document prêt, lance les scripts js
$(document).ready(function() {
    bbcode();
    game();
    jquery_back();
    jquery_easing();
    jquery_path();
});