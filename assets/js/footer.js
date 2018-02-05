module.exports = function() {
    
    var window_width = $(window).width();
    footer_loop = function(){
        $('#footer_character').animate({
            left: window_width + 70
            }, 
            15000, 
            "linear",
        function(){
            $('#footer_character').delay(5000).attr("style", "left: -70px");
            footer_loop();
        });
    };
    footer_loop();
    
};