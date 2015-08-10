$(document).ready(function() {
    var needNews = true;
    $(window).scrollTop(0);

    $('input').bind('input', function() {
        $(this).val();
    });

    $('textarea').bind('change', function() {
        var text = $(this).val();
        $(this).text(text);
    });

    //details action
    $('body').on('click', '.details', function() {
        var id = $(this).parents('.news-row').data('id');
        $.ajax({
            type: "POST",
            url: "/get",
            data: {id: id},
            dataType: 'json',
            success: function(data)
            {
                if (data["result"]) {
                    $('#detailsModal').find('.modal-title').html(data["news"].title);
                    $('#detailsModal').find('.modal-body').html(data["news"].text);
                    $('#detailsModal').modal('show');
                } else {
                    //todo implement users notification via data['message']
                    alert('Unable to get news #' + id);
                }
            }
        });
    });

    //get for edit action
    $('body').on('click', '.edit', function() {
        var id = $(this).parents('.news-row').data('id');
        $.ajax({
            type: "POST",
            url: "/get",
            data: {id: id},
            dataType: 'json',
            success: function(data)
            {
                if (data["result"]) {
                    $('#editModal').find('#edit-title').val(data["news"].title);
                    $('#editModal').find('#news-row-id').val(id);
                    $('#editModal').find('#edit-text').html(data["news"].text);
                    $('#editModal').modal('show');
                } else {
                    alert('Unable to get news #' + id);
                }
            }
        });
    });

    //edit action
    $('body').on('click', '#save-btn', function() {
        //todo implement input validation
        var id = $('#editModal').find('#news-row-id').val();
        var title = $('#editModal').find('#edit-title').val();
        var text = $('#editModal').find('#edit-text').html();
        var action = id ? '/edit' : '/add';
        $.ajax({
            type: "POST",
            url: action,
            data: {id: id, title: title, text: text},
            dataType: 'json',
            success: function(data)
            {
                if (data["result"]) {
                    if (id) {
                        var row = $('.news-row[data-id=' + id + ']');
                        row.find('.news-title-header').html(title);
                        row.find('.news-text').html(text);
                    } else {
                        $('#news-box').prepend(data['news']);
                    }
                    $('#editModal').modal('hide');
                } else {
                    $('#editModal').modal('hide');
                    if (id) {
                        alert('Unable to edit news #' + id);
                    } else {
                        alert('Unable to add news');
                    }
                }
            }
        });
    });

    //add pre-action
    $('body').on('click', '#add-news-btn', function() {
        var id = $('#editModal').find('#news-row-id').val(null);
        var title = $('#editModal').find('#edit-title').val(null);
        var text = $('#editModal').find('#edit-text').html(null);
        var text = $('#editModal').find('#edit-text').val(null);
        $('#editModal').modal('show');
    });

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
                    alert('Unable to delete news #' + id);
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
            url: "/getBatch",
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