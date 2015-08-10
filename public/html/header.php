<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://news.dev/css/main.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
</head>

<body>
    <!-- Modal -->
    <div id="detailsModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <input type="hidden" id="news-row-id"/>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <input type="text" id="edit-title"  class="form-control" placeholder="Title"/>
                    </h4>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" rows="5" id="edit-text" placeholder="Text"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="save-btn">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


    <div class="page-header">
        <h3>One-page news feed</h3>
    </div>

    <div>
        <button class="btn btn-success" id="add-news-btn">Add news</button>
    </div>
    <hr />
    <div class="box">
        <div class="row">
            <!-- main -->
            <div class="column col-sm-12" id="main">
                <div class="padding">
                    <div class="full col-sm-12" id="news-box">