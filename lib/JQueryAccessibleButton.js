$(function() {

    $("#accordion_withButton").accordion({
        collapsible: false,
        autoHeight: false,
        event: "mouseover"
    });

    $("#radioButton").buttonset();
    $('#radioButton').change(function() {
        var isChecked = $("input[name='radioButton']:checked");
        var button = $("input[name='radioButton']:checked").val();
        var phpAjax = "";
        var title = "";
        if(button == "archives") {
            phpAjax = "wp-content/plugins/jquery-accessible-button/getArchivesAjax.php";
            title = "Archives";
        } else if(button == "posts") {
            phpAjax = "wp-content/plugins/jquery-accessible-button/getRecentPostsAjax.php";
            title = "Recent Posts";
        } else if(button == "comments") {
            phpAjax = "wp-content/plugins/jquery-accessible-button/getRecentCommentsAjax.php";
            title = "Recent Comments";
        } 
        if (isChecked) {
            $.ajax({
                type: "GET",
                url: phpAjax,
                dataType: "json",
                success: function(msg){
                    $('.areaAButton').empty();
                    $('.areaAButton').append(msg["title"]);
                    $('.areaBButton').empty();
                    $('.areaBButton').removeAttr("style");
                    $('.areaBButton').append('<ul>' + msg["list"] + '</ul>');
                }
            });
        } 
        return false;
    });

});
