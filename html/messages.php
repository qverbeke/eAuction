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
  <div class="container" style="margin-top:50px">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#inbox">Inbox</a></li>
      <li><a data-toggle="tab" href="#outbox">Outbox</a></li>
      <li><a data-toggle="tab" href="#drafts">Drafts</a></li>
    </ul>
  </div>
  <div class="tab-content" style="padding-top:10px; width:50%; margin-left:25%;">
    <div id="inbox" class="tab-pane fade in active">
      <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1"> Message from John: <h5>
              <small> 5 days ago <small>
          </div>
        </a>
        <a href="#" class="list-group-item list-group-item-action align-items-start">
          5 days ago <br>
          Message from John: <br>
          Hello how is it going?
        </a>
      </div>
    </div>
    <div id="outbox" class="tab-pane fade">
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="drafts" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
  </div>
</body>
