module.exports = function () {
    $(".form__step").hide();
    $(".form__step:first-of-type").show();

    var step =1;

    $("[data-form-step]").click(function() {
        if ($(this).data('form-step') == "next") {
            $(".form__step:nth-of-type("+step+")").hide();
            step++;
            $(".form__step:nth-of-type("+step+")").show();
        }
        else if ($(this).data('form-step') == "submit") {

            var form = $(this).closest('form');

            var data = {};
            data[$("#forum_section_section_name").attr('name')] = $("#forum_section_section_name").val();
            data[$("#forum_section_description").attr('name')] = $("#forum_section_description").val();
            data[$("#forum_section_access").attr('name')] = $("#forum_section_access").val();
            data[$("#forum_section__token").attr('name')] = $("#forum_section__token").val();

            $.ajax({
                url : form.attr('action'),
                type: form.attr('method'),
                data : data,
                success: function(result) {
                    console.log(result);
                    console.log($(result).find(".forum__partie:last-of-type"));
                    $( ".forum__ajout__partie" ).before($(result).find(".forum__partie:last-of-type"));
                }
            });
        }
    });
};