module.exports = function()
{
    $("*[data-event='navbar-btn-dropdown']").click(function(){

        if($("*[data-event='navbar-dropdown-content']").is(':hidden'))
        {
            $("*[data-event='navbar-dropdown-content']").show(150);
        }
        else
        {
            $("*[data-event='navbar-dropdown-content']").hide(150);
        }

    });

};