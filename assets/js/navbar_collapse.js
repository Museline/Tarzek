module.exports = function()
{
    $("*[data-event='navbar-btn-collapse']").click(function(){
        if($("*[data-event='navbar-collapse']").is(':hidden'))
        {
            $("*[data-event='navbar-collapse']").show(300);
        }
        else
        {
            $("*[data-event='navbar-collapse']").hide(300);
        }
    });
};