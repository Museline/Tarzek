// require css base
require('../css/base/base.css');
require('../css/base/nav.css');
require('../css/base/footer.css');
require('../css/base/body.css');
require('../css/base/header.css');
// require css module
require('../css/module/jeu.css');
require('../css/module/rope.css');
require('../css/module/form.css');
require('../css/module/btn.css');
require('../css/module/col.css');
require('../css/module/table.css');
require('../css/module/advert.css');
require('../css/module/profil.css');
require('../css/module/messaging.css');
require('../css/module/forum.css');
require('../css/module/image_js.css');

// charge jquery depuis les package le node_modules
var $ = require('jquery');

// require js
var bbcode = require('./btn_text-editor_bbcode.js');
var game = require('./jeux.js');
var jquery_back = require('./jquery.backgroundpos');
var jquery_easing = require('./jquery.easing.1.3');
var jquery_path = require('./jquery.path');
var multi_step_form = require('./multi_step_form');
var navbar_dropdown = require('./navbar_dropdown');
<<<<<<< HEAD
var move_footer = require('./footer');
var image_js = require('./image_js.js');
=======
var move_footer = require('./footer')
var navbar_collapse = require('./navbar_collapse');
>>>>>>> d3b40b17dd5d03b79e51baef21814415f3171c62

// une fois le document prêt, lance les scripts js
$(document).ready(function() {
    bbcode();
    game();
    jquery_back();
    jquery_easing();
    jquery_path();
    multi_step_form();
    navbar_dropdown();
    move_footer();
    navbar_collapse();
});