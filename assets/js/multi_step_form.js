module.exports = function () {
    $(".form__step").hide();
    $(".form__step:first-of-type").show();

    $("[data-form-step]").click(function() {


        if ($(this).data('form-step') == "next") {
            // récupère le div class="form__step" parent du button cliqué et le cache
            var parent = $(this).parent();
            $(parent).hide();
            // récupère le div suivant et l'affiche
            var next = parent.next();
            $(next).show();
        }
        else if ($(this).data('form-step') == "submit") {

            var form = $(this).closest('form');

            var data = {};
            var input = $(form).find('#forum_section_section_name');
            data[$(input).attr('name')] = $(input).val();
            var input = $(form).find('#forum_section_description');
            data[$(input).attr('name')] = $(input).val();
            var input = $(form).find('#forum_section_access');
            data[$(input).attr('name')] = $(input).val();
            var input = $(form).find('#forum_section_hierarchy');
            data[$(input).attr('name')] = $(input).val();
            var input = $(form).find('#forum_section_parent_section');
            data[$(input).attr('name')] = $(input).val();
            var input = $(form).find('#forum_section__token');
            data[$(input).attr('name')] = $(input).val();

            $.ajax({
                url : form.attr('action'),
                type: form.attr('method'),
                data : data,
                success: function(result) {
                    console.log(result);
                }
            });
        }
    });
};