<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://news.dev/css/main.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">
        var needNews = true;
        $(document).ready(function() {
            $(window).scrollTop(0);
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
        });
        $(window).scroll(function()
        {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 100 && needNews)
            {
                getNews();
            }
        });

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
    </script>
</head>

<body>

    <div class="page-header">
        <h3>One-page news feed</h3>
    </div>

    <div>
        <button class="btn btn-success">Add news</button>
    </div>
    <hr />
    <div class="box">
        <div class="row">
            <!-- main -->
            <div class="column col-sm-12" id="main">
                <div class="padding">
                    <div class="full col-sm-12" id="news-box">