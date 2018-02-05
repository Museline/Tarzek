module.exports = function() {
    
    image_loop = function(){
        $('#image_character').animate({
            left: 230
            },
            5000,
            'linear',
        function(){
            $('#image_character').delay(5000).attr("style", "left: 0");
            image_loop();
        });
    };
    image_loop();
};
