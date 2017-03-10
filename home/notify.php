<?php  
  $current_day = lcfirst(substr(date('l'),0,3));
  
  $result = $func->myResult("SELECT start_time FROM timetables WHERE day = ? AND user_id = ?","si",array($current_day, $_SESSION['user_id']));

  $time = "";  
  while($row = $result->fetch_assoc()) 
    $time .= "'".date("H:i",strtotime($row['start_time']))."',";

  $time = str_replace(":", "", rtrim($time,","));
?>

<script>
$(document).ready(function(){
  function notifyMe() {
    // Let's check if the browser supports notifications
    if (!("Notification" in window)) {
      alert("This browser does not support desktop notification");
    }

    // Let's check whether notification permissions have already been granted
    else if (Notification.permission === "granted") {
      // If it's okay let's create a notification
    }

    // Otherwise, we need to ask the user for permission
    else if (Notification.permission !== 'denied') {
      Notification.requestPermission(function (permission) {
        // If the user accepts, let's create a notification
        if (permission === "granted") {
          spawnNotification('Hi <?php echo $_SESSION['user_name'] ?>', 'assets/img/<?php echo $_SESSION['image'] ?>', "Notification tray up and running. Enjoy the app");
        }
      });
    }

    // At last, if the user has denied notifications, and you 
    // want to be respectful there is no need to bother them any more.
  }

  function spawnNotification(theTitle,theIcon,theBody) {
    var options = {
        body: theBody,
        icon: theIcon
    }
    var n = new Notification(theTitle,options);
  }
  notifyMe();

  // current day time array
  $time = [<?php echo $time; ?>];

  function updateClock(){

    var currentTime = new Date ( );
    var currentHours = currentTime.getHours ( );
    var currentMinutes = currentTime.getMinutes ( );

    if (currentHours < 10) currentHours = '0'+currentHours;
    if (currentMinutes < 10) currentMinutes = '0'+currentMinutes;

    $.each($time, function(i, val){
      $due_time = parseInt(val);
      $current_time = parseInt(currentHours + "" + currentMinutes);


      if ($current_time == $due_time){
          spawnNotification('Hey <?php echo $_SESSION['user_name'] ?>', 'assets/img/<?php echo $_SESSION['image'] ?>', "Look like one of your <?php echo date("l"); ?> schedule is due.");
      }
    });

    // Compose the string for display
    var currentTimeString = currentHours + ":" + currentMinutes;
    
    $(".time").text(currentTimeString);
        
  }

  function updateSeconds(){
    var currentTime = new Date ();
    var currentSeconds = currentTime.getSeconds ( );
    if (currentSeconds < 10) currentSeconds = '0'+currentSeconds;
    $(".seconds").text(currentSeconds);
  }
  updateClock();
  // updateSeconds();

  setInterval(updateClock, 1000*30);
  // setInterval(updateSeconds, 1000);



});
</script>