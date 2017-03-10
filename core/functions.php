<?php  

    class myFunc{

        // my mysqli sql query result function || uses prepared statement
        function myResult($query, $datatype, $variables){
            include("db.php");
            $stmt = $conn->prepare($query);
            $param = array();
            $count = count($variables);
            for($i = 0; $i < $count; ++$i){
                $param[] = &$variables[$i];
            }
            array_unshift($param, $datatype);
            call_user_func_array(array($stmt, 'bind_param'), $param);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conn->close();

            return $result;
        }

        // my mysqli api fetch function || uses prepared statement
        function myFetch($query, $datatype, $variables){
            include("db.php");
            $stmt = $conn->prepare($query);
            $param = array();
            $count = count($variables);
            for($i = 0; $i < $count; ++$i){
                $param[] = &$variables[$i];
            }
            array_unshift($param, $datatype);
            call_user_func_array(array($stmt, 'bind_param'), $param);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conn->close();

            return $result->fetch_assoc();
        }

        // my email function
        function sendmail($to,$from,$subject,$message){
        
            // headers
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
              
            //send email
            mail($to, "$subject", $message, $headers);
        }

        // my salt function.
        function cryptPass($input, $rounds = 9){
            $salt = "";

            $saltChars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
            for($i = 0; $i < 22; $i++){
                $salt .= $saltChars[array_rand($saltChars)];
            }
            return crypt($input, sprintf('$2y$%02d$', $rounds) . $salt);
        }

        function imgUpload($path,$imgName,$imgTemp,$imgSize){ 
            $target_dir = $path;
            $target_file = $target_dir . basename($imgName);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
                $check = getimagesize($imgTemp);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo '<p class="text-center"> File is not an image</p>';
                    $uploadOk = 0;
                    return false;
                }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo '<p class="text-center"> Oops, this image already exist yeah.</p>';
                $uploadOk = 0;
                return true;
            }
            // Check file size
            if ($imgSize > 1000000) {
                echo '<p class="text-center"> Image too big, please compress</p>';
                $uploadOk = 0;
                return false;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo '<p class="text-center">Only image of type jpg, jpeg, gif and png are accepted</p>';
                $uploadOk = 0;
                return false;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo '<p class="text-center"> Sorry but your image was not uploaded</p>';
            // if everything is ok, try to upload file
                return false;
            } else {
                if (move_uploaded_file($imgTemp, $target_file)) {
                    return true;
                } else {
                    echo '<p class="text-center"> We encounterd an error whiles processing your image</p>';
                    return false;
                }
            }
        }

        function fileUpload($path,$name,$temp,$size){ 
            $target_dir = $path;
            $target_file = $target_dir . basename($name);
            $uploadOk = 1;
            $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
            
            // Check if file already exists
            if (file_exists($target_file)) {
                $uploadOk = 0;
                return true;
            }
            // Check file size
            if ($size > (16777216*64)) {
                echo '<p class="text-center">Maximum size limits, 1GB</p>';
                $uploadOk = 0;
                return false;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo '<p class="text-center"> Sorry but your file was not uploaded</p>';
            // if everything is ok, try to upload file
                return false;
            } else {
                if (move_uploaded_file($temp, $target_file)) {
                    return true;
                } else {
                    echo '<p class="text-center"> We encounterd an error whiles uploading your files</p>';
                    return false;
                }
            }
        }

        function timeAgo($timestamp){
            $datetime1=new DateTime("now");
            $datetime2=date_create($timestamp);
            $diff=date_diff($datetime1, $datetime2);
            $timemsg='';
            if($diff->y > 0){
                $timemsg = $diff->y .' year'. ($diff->y > 1?"s":'');

            }
            else if($diff->m > 0){
             $timemsg = $diff->m . ' month'. ($diff->m > 1?"s":'');
            }
            else if($diff->d > 0){
             $timemsg = $diff->d .' day'. ($diff->d > 1?"s":'');
            }
            else if($diff->h > 0){
             $timemsg = $diff->h .' hour'.($diff->h > 1 ? "s":'');
            }
            else if($diff->i > 0){
             $timemsg = $diff->i .' minute'. ($diff->i > 1?"s":'');
            }
            else if($diff->s > 0){
             $timemsg = $diff->s .' second'. ($diff->s > 1?"s":'');
            }

            $timemsg = $timemsg.' ago';
            return $timemsg;
        }

        function trim($input, $length, $ellipses = true, $strip_html = true) {
            //strip tags, if desired
            if ($strip_html) {
                $input = strip_tags($input);
            }
          
            //no need to trim, already shorter than trim length
            if (strlen($input) < $length) {
                return $input;
            }
          
            //find last space within length
            $last_space = strrpos(substr($input, 0, $length), ' ');
            $trimmed_text = substr($input, 0, $last_space);
          
            //add ellipses (...)
            if ($ellipses) {
                $trimmed_text .= '...';
            }
          
            return $trimmed_text;
        }

        function auto_link($text) {
          $pattern = '/(((http[s]?:\/\/(.+(:.+)?@)?)|(www\.))[a-z0-9](([-a-z0-9]+\.)*\.[a-z]{2,})?\/?[a-z0-9.,_\/~#&=:;%+!?-]+)/is';
          $text = preg_replace($pattern, ' <a href="$1" target="_blank" rel="nofollow">$1</a>', $text);
          // fix URLs without protocols
          $text = preg_replace('/href="www/', 'href="http://www', $text);
          return $text;
        }
    }
?>