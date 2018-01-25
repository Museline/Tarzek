// charge jquery depuis les package le node_modules
var $ = require('jquery');

// require js
var bbcode = require('./btn_text-editor_bbcode.js');

// une fois le document prêt, lance les scripts js
$(document).ready(function() {
    bbcode();
});