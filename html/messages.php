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
        <?php
          include_once 'connect-to-database.php';
          $Receiver_UID = $_SESSION["UID"];
          $sql_statement = "SELECT M.Time, M.Sender_UID, M.Content
          FROM Message M WHERE M.Receiver_UID='$Receiver_UID' AND M.Is_Draft=0";
          $result = mysqli_query($conn, $sql_statement);
          if(!$result){
            echo 'Could not run query: ' . mysqli_error($conn);
            exit();
          }
          for ($i = 0; $i < mysqli_num_rows($result); $i++){
            $row = mysqli_fetch_row($result);
            $sql_statement = "SELECT U.Username FROM User_Username U WHERE U.UID='$row[1]'; ";
            $result2 = mysqli_query($conn, $sql_statement);
            $username = mysqli_fetch_row($result2)[0];
            echo '<a href="#" class="list-group-item list-group-item-action align-items-start">'
                  . $row[0] . '<br> Message from ' . $username .
                  '<br>' . $row[2] . '</a>';
          }
        ?>
      </div>
    </div>
    <div id="outbox" class="tab-pane fade">
      <div class="list-group">
        <?php
          include_once 'connect-to-database.php';
          $Sender_UID = $_SESSION["UID"];
          $sql_statement = "SELECT M.Time, M.Receiver_UID, M.Content
          FROM Message M WHERE M.Sender_UID='$Sender_UID' AND M.Is_Draft=0";
          $result = mysqli_query($conn, $sql_statement);
          if(!$result){
            echo 'Could not run query: ' . mysqli_error($conn);
            exit();
          }
          for ($i = 0; $i < mysqli_num_rows($result); $i++){
            $row = mysqli_fetch_row($result);
            $sql_statement = "SELECT U.Username FROM User_Username U WHERE U.UID='$row[1]'; ";
            $result2 = mysqli_query($conn, $sql_statement);
            $username = mysqli_fetch_row($result2)[0];
            echo '<a href="#" class="list-group-item list-group-item-action align-items-start">'
                  . $row[0] . '<br> Message sent to ' . $username .
                  '<br>' . $row[2] . '</a>';
          }
        ?>
      </div>
    </div>
    <div id="drafts" class="tab-pane fade">
      <?php
        include_once 'connect-to-database.php';
        $Sender_UID = $_SESSION["UID"];
        $sql_statement = "SELECT M.Time, M.Receiver_Username, M.Content
        FROM Message M WHERE M.Sender_UID='$Sender_UID' AND M.Is_Draft=1";
        $result = mysqli_query($conn, $sql_statement);
        if(!$result){
          echo 'Could not run query: ' . mysqli_error($conn);
          exit();
        }
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
          $row = mysqli_fetch_row($result);
          echo '<a href="#" class="list-group-item list-group-item-action align-items-start">'
                . $row[0] . '<br> Sending to ' . $row[1] .
                '<br>' . $row[2] . '</a>';
        }
      ?>
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
            <form action="action_send.php" method="post" role="form">
              <div class="modal-body mx-3">
                  <div class="md-form mb-5">
                      <i class="fa fa-envelope prefix grey-text"></i>
                      <label>To</label>
                      <input type="text" id="to" name="to" class="form-control validate">
                  </div>

                  <div class="md-form mb-4">
                      <i class="fa fa-lock prefix grey-text"></i>
                      <label>Message</label>
                      <textarea rows='5' type="text" name="message" id="message" class="form-control validate"></textarea>
                  </div>
              </div>
              <div class="modal-footer d-flex justify-content-center">
                <button type="submit" name="action" value="save" class="btn btn-default">Save as Draft </button>
                <button type="submit" name="action" value="send" class="btn btn-default">Send</button>
              </div>
            </form>
        </div>
    </div>
</div>

</body>
