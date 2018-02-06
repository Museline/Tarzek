module.exports = function() {
    
    var bezier_params = {
                start: {
                    x: 90,
                    y: 255,
                    angle: 10
                },
                end: {
                    x: 210,
                    y: 255,
                    angle: 80,
                    length: 3
                }
            };
    
    image_loop = function(){
        $('#image_character').animate({
        left: 90
        },
        1000,
        'linear',
        function(){
            item_loot();
            $('#image_character').animate({
                path: new $.path.bezier(bezier_params)
                },
                1000,
                function () {
                    $('#image_character').animate({
                        left:300 
                    },
                    1000,
                    'linear',
                    function(){
                        $('#image_character').delay(3000).attr("style", "left: 0");
                        image_loop();
                        
                        
                    });  
            });
            
        });
        
    };
    image_loop();
    
    item_loot = function(){
        $('.image_box').delay(200).animate({
                'top': '100px'
                }, 
                200).fadeOut(200,
                function () {
                    $('.image_box').delay(4000).attr("style", "top: 160px").fadeIn(200);
                    });
    };
    
    setInterval(function () {
        $(".c_image").animate({top: 25}, 800).animate({top: 30}, 800);
    }, 500);
};
