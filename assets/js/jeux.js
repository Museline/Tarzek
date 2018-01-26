module.exports = function () {

    $("#container").delay(1000).animate(
        {"backgroundPosition": "0px 0px"},
        {
            duration: 800,
            esasing: 'easeOutBounce'
        });
    $(".box").css({top: -100});
    $(".box").delay(1200).animate(
        {top: 268},
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
            top: 377
        },
        {
            duration: 1000,
            easing: 'easeOutBounce'
        });
    $("#sun").hide().delay(1500).fadeIn(500);

    setInterval(function () {
        $(".c1").animate({top: 45}, 800).animate({top: 50}, 800);
    }, 1500);
    setInterval(function () {
        $(".c2").animate({top: 45}, 800).animate({top: 50}, 800);
    }, 1000);
    setInterval(function () {
        $(".c3").animate({top: 45}, 800).animate({top: 50}, 800);
    }, 2000);
    $(".cloud").hide().css({top: 70}).delay(2000).fadeIn(200);

    var score = 0;
    var life = 1;
    $(window).keydown(function (event) {
        var posX = $("#perso").position().left;
        // console.log(posX);

        $("#lifeNumb").html(life);

        if (life == 1) {
            if (event.keyCode == '39') {
                if ((posX > 0) && (posX < 980)) {
                    $("#perso")
                        .removeClass("dos")
                        .css({
                            backgroundPosition: '0px -44px'
                        })
                        .animate({left: '+=5'}, 20, "linear");
                }
            }
            if (event.keyCode == '37') {
                if ((posX > 0) && (posX < 980)) {
                    $("#perso")
                        .addClass("dos")
                        .css({
                            backgroundPosition: '0px -44px'
                        })
                        .animate({left: '-=5'}, 20, "linear");
                }
            }

            var bezier_paramsdos = {
                start: {
                    x: posX,
                    y: 377,
                    angle: 350
                },
                end: {
                    x: posX - 60,
                    y: 377,
                    angle: 100,
                    length: -4
                }
            };

            var bezier_params = {
                start: {
                    x: posX,
                    y: 377,
                    angle: 10
                },
                end: {
                    x: posX + 60,
                    y: 377,
                    angle: 80,
                    length: 4
                }
            };

            if (event.keyCode == '38') {
                if ($("#perso").hasClass("dos")) {
                    if ((posX > 60) && (posX < 980)) {
                        if ((posX < 511) && (posX > 461)) {
                            $(".b1").delay(160).animate({
                                'top': '210px'
                            }, 200).fadeOut(200, function () {
                                $("#scoreNumb").html(score += 50);
                            });
                        }
                        ;
                        if ((posX < 841) && (posX > 791)) {
                            $(".b2").delay(160).animate({
                                'top': '210px'
                            }, 200).fadeOut(200, function () {
                                $("#scoreNumb").html(score += 50);
                            });
                        }
                        ;
                        if ((posX < 941) && (posX > 891)) {
                            $(".b3").delay(160).animate({
                                'top': '210px'
                            }, 200).fadeOut(200, function () {
                                $("#scoreNumb").html(score += 50);
                            });
                        }
                        ;
                        $("#perso").stop(true, true).css({
                            backgroundPosition: '-30px -44px'
                        }).animate({
                            path: new $.path.bezier(bezier_paramsdos)
                        }, 500, function () {
                            $("#perso").css({
                                backgroundPosition: '0px -44px'
                            })
                        });
                    }
                }
                else {
                    if ((posX > 0) && (posX < 920)) {
                        if ((posX > 411) && (posX < 461)) {
                            $(".b1").delay(160).animate({
                                'top': '210px'
                            }, 200).fadeOut(200, function () {
                                $("#scoreNumb").html(score += 50);
                            });
                        }
                        ;
                        if ((posX > 741) && (posX < 791)) {
                            $(".b2").delay(160).animate({
                                'top': '210px'
                            }, 200).fadeOut(200, function () {
                                $("#scoreNumb").html(score += 50);
                            });
                        }
                        ;
                        if ((posX > 841) && (posX < 891)) {
                            $(".b3").delay(160).animate({
                                'top': '210px'
                            }, 200).fadeOut(200, function () {
                                $("#scoreNumb").html(score += 50);
                            });
                        }
                        ;
                        $("#perso").stop(true, true).css({
                            backgroundPosition: '-30px 0px'
                        }).animate({
                            path: new $.path.bezier(bezier_params)
                        }, 500, function () {
                            $("#perso").css({
                                backgroundPosition: '0px 0px'
                            })
                        });
                    }
                }
            }
            var posY = $("#perso").position().top;

            // console.log(posY);
            if ($("#perso").hasClass("dos")) {
                if ((posX > 585) && (posX < 625)) {
                    if ((posY < 380)) {
                        $("#perso").animate({
                            'top': '600px'
                        }, 2000, function () {
                            life = 0;
                        });
                    }
                }
            }
            else {
                if ((posX > 585) && (posX < 625)) {
                    if ((posY < 378)) {
                        $("#perso").animate({
                            'top': '600px'
                        }, 2000, function () {
                            life = 0;
                        });
                    }
                }
            }
        }
        if (life == 0) {
            $("#gameOver").animate({
                "top": "200px"
            }, 800, function () {

            });
        }
        $(".dev").html("X:" + posX + " Y:" + posY);
    });

};
