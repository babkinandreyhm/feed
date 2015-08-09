$(document).ready(function() {
    var needNews = true;
    $(window).scrollTop(0);

    //delete action
    $('body').on('click', '.delete', function() {
        var id = $(this).parents('.news-row').data('id');
        if (!confirm('U r sure to delete news with #' + id + '?')) {
            return;
        }
        $.ajax({
            type: "POST",
            url: "/delete",
            data: {id: id},
            dataType: 'json',
            success: function(data)
            {
                var row = $('.news-row[data-id=' + id + ']');
                if (data["result"]) {
                    row.remove();
                    if ($('.box').height() < 600) {
                        getNews();
                    }
                } else {
                    alert('Unable to delete');
                }
            }
        });
    });


    $(window).scroll(function()
    {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 100 && needNews)
        {
            getNews();
        }
    });

    //get next chunk action
    function getNews() {
        $('div#loadmoreajaxloader').show();
        var lastId = $('#last-id').val();
        $.ajax({
            type: "POST",
            url: "/get",
            data: {lastId: lastId},
            dataType: 'json',
            success: function(data)
            {
                if (data["result"]) {
                    $("#news-box").append(data['html']);
                    $('#last-id').val(data['lastId']);
                    $('div#loadmoreajaxloader').hide();
                } else {
                    $('div#loadmoreajaxloader').html(
                        '<center><div class="alert alert-info">No more news to show</div></center>'
                    );
                    needNews = false;
                }
            }
        });
    }
});