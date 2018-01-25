/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$('document').ready(function(){
    $("#container").delay(1000).animate(
        {"backgroundPosition" :"0px 0px"},
        {
            duration: 800,
            esasing: 'easeOutBounce'
        });
    $(".case").css({top:-100});
    $(".case").delay(1200).animate(
        {top:268},
        {
            duration: 1000,
            easing: 'easeOutBounce'
        });
    $("#perso").delay(1600).css(
        {
            top: -100
        });
    $("#perso").delay(500).animate(
        {
            top:377
        },
        {
            duration: 1000,
            easing: 'easeOutBounce'
        });
    $("#legend").hide().delay(1500).fadeIn(500);
});
setInterval(function(){
    $(".smile").animate({top: 140}, 800).animate({top: 150},800);
}, 1600);
$(".smile").hide().css({top: 170}).delay(2000).fadeIn(200);

$(window).keydown(function(event){
    var pos = $("#perso").position().left;
    if(event.keyCode == '39'){
        if((pos > 0) && (pos < 980)){
            $("#perso")
                .removeClass("dos")
                .css({
                    backgroundPosition: '0px -44px'
                })
                .animate({left: '+=5'}, 20, "linear");  
        }    
    }
    if(event.keyCode == '37'){
        if((pos > 0) && (pos < 980)){
            $("#perso")
                .addClass("dos")
                .css({
                    backgroundPosition: '0px -44px'
                })
                .animate({left: '-=5'}, 20, "linear");  
        }    
    }
    
    var bezier_paramsdos ={
        start: {
            x: pos,
            y: 377,
            angle: 350
        },
        end: {
            x: pos - 60,
            y: 377,
            angle: 100,
            length: -4
        }
    };
    
    var bezier_params = {
        start: {
            x: pos,
            y: 377,
            angle: 10
        },
        end: {
            x: pos + 60,
            y: 377,
            angle: 80,
            length: 4
        }
    };
    
    if (event.keyCode == '38'){
        if($("#perso").hasClass("dos")){
            if((pos > 60) && (pos < 980)){
                if((pos<511)&&(pos>461)){
                    $(".c1").delay(160).animate({
                        'top': '210px'
                    }, 200).fadeOut(200, function(){
                        $(location).attr('href', "#");
                    });
                };
                if((pos < 841) && (pos > 791)){
                    $(".c2").delay(160).animate({
                        'top': '210px'
                    }, 200).fadeOut(200, function(){
                        $(location).attr('herf', "#");
                    });
                };
                if ((pos < 941) && (pos >891)){
                    $(".c3").delay(160).animate({
                        'top': '210px'
                    }, 200).fadeOut(200, function(){
                        $(location).attr('href', "#");
                    });
                };
                $("#perso").stop(true, true).css({
                    backgroundPosition: '-30px -44px'
                }).animate({
                    path: new $.path.bezier(bezier_paramsdos)
                }, 500, function(){
                    $("#perso").css({
                        backgroundPosition: '0px -44px'
                    })
                });
            }
        }
        else{
            if((pos > 0) && (pos < 920)){
                if ((pos > 411) && (pos < 461)){
                    $(".c1").delay(160).animate({
                        'top': '210px'
                    }, 200).fadeOut(200, function(){
                        $(location).attr('href', "#");
                    });
                };
                if ((pos > 741) && (pos < 791)){
                    $(".c1").delay(160).animate({
                        'top': '210px'
                    }, 200).fadeOut(200, function(){
                        $(location).attr('href', "#");
                    });
                };
                if ((pos > 841) && (pos < 891)){
                    $(".c1").delay(160).animate({
                        'top': '210px'
                    }, 200).fadeOut(200, function(){
                        $(location).attr('href', "#");
                    });
                };
                $("#perso").stop(true, true).css({
                    backgroundPosition: '-30px 0px'
                }).animate({
                    path: new $.path.bezier(bezier_params)
                }, 500, function(){
                    $("#perso").css({
                        backgroundPosition: '0px 0px'
                    })
                });
            }
        }
    }
});