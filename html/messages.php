<!DOCTYPE html>
<head>
  <title>The Better Bookstore</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script>
      $(document).ready(function(){
        $('#navbar').load("navbar.html");
        });
  </script>

</head>
<body>
  <div id="navbar">
  </div>
  <div class="container" style="margin-top:53px;">
    <ul class="nav nav-tabs" style="margin-botton:0px; ">
      <li class="active"><a data-toggle="tab" href="#inbox">Inbox</a></li>
      <li><a data-toggle="tab" href="#outbox">Outbox</a></li>
      <li><a data-toggle="tab" href="#drafts">Drafts</a></li>
      <li class="pull-right"> <button type="button" class="btn btn-primary"
         data-toggle="modal" data-target="#compose-form">Compose</button></li>
    </ul>

  </div>
  <div class="tab-content" style="padding-top:10px; width:50%; margin-left:25%;">
    <div id="inbox" class="tab-pane fade in active">
      <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action align-items-start">
          5 days ago <br>
          Message from John: <br>
          Hello how is it going?
        </a>
      </div>
    </div>
    <div id="outbox" class="tab-pane fade">
      <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action align-items-start">
          5 days ago <br>
          Message sent to John: <br>
          Hello how is it going?
        </a>
      </div>
    </div>
    <div id="drafts" class="tab-pane fade">
      <div class="list-group">
        <a data-target="#compose-form" data-toggle="modal" class="list-group-item list-group-item-action align-items-start">
          5 days ago <br>
          Draft to John: <br>
          Hello how is it going?
        </a>
      </div>
    </div>
  </div>

  <div class="modal fade" id="compose-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Compose New Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    <label>To</label>
                    <input type="text" id="to" class="form-control validate">
                </div>

                <div class="md-form mb-4">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <label>Message</label>
                    <textarea rows='5' type="text" id="message" class="form-control validate"></textarea>
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-default">Login</button>
            </div>
        </div>
    </div>
</div>

</body>
