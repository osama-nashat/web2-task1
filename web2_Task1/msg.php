<?php 


$valid_name="";
$valid_email="";
$valid_msg="";
$valid_image="";
$email_exist="";



if(isset($_POST['send'])){

    if(isset($_FILES['image'])){
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        
        $extensions= array("jpg");
        
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['massage'];

    $fileHandle1 = fopen("emails.txt",'a+');

    $read = fread($fileHandle1,filesize('emails.txt'));

    fclose($fileHandle1);

   
    $valid_name = preg_match("/^[[:upper:]][[:alpha:]]+[ ][[:alpha:]]+([ ]*[[:alpha:]]*)*$/",$name);
    $valid_email = preg_match("/^[[:alpha:]][[:alnum:]]+[._]?[[:alnum:]]+[@][[:alpha:]]{4,}[.][[:alpha:]]{2,3}$/",$email);
    $email_exist = preg_match("/{$email}/i", $read);
    $valid_msg = strlen($msg) < 160 ;
    $valid_image = in_array($file_ext,$extensions) === true;


    if($valid_name && $valid_email && $valid_msg && !$email_exist && $valid_image){

        $fileHandle = fopen("emails.txt",'a+');
        $write = fwrite($fileHandle,$email);
        fclose($fileHandle);

        $handle1 = fopen("usernamefile.txt",'a+');
        fwrite($handle1,$name."\r\n");
        fclose($handle1);

        $handle2 = fopen("messagefile.txt",'a+');
        fwrite($handle2,$msg."\r\n");
        fclose($handle2);

        $handle3 = fopen("imagesfile.txt",'a+');
        fwrite($handle3,$file_name."\r\n");
        fclose($handle3);


        move_uploaded_file($file_tmp,"images/".$file_name);


        header('Location:thanks.php');
        
    } 
    
    if(!$valid_name){
        echo '<span class="wrong-name">name must strat with upper case and consist of 2 syllables containing no <br> number or special characters *</span>';
    }

    if(!$valid_email){
        echo '<span class="wrong-email">email must follow an email format of AAA@BBBB.CCC *</span>';
    }

    if($email_exist){
        echo '<span class="wrong-email">this email has been used before *</span>';
    }

    if(!$valid_msg){
        echo '<span class="wrong-msg">the message must not exceed 160 characters *</span>';
    }

    if(!$valid_image){
        echo '<span class="wrong-image">photos must be of (.jpg) file type *</span>';
    }
}


?>





<html>

<header>

    <meta charset="UTF-8">
    <title>Graduation Book</title>
    <link rel="stylesheet" type="text/css" href="msg.css">

</header>

<body>

    <div class="form-container">

        <form class="msg-form" action="msg.php" method="post" enctype="multipart/form-data">

            <h1>Write a Massage</h1>

            <input type="text" name="name" placeholder="Full Name">

            

            <input type="text" name="email" placeholder="Email">

            <textarea name="massage" placeholder="your massage"></textarea>

            <label>Upload image : </label>
            <input type="file" name="image">
    
            <input type="submit" name="send" value="send">

        </form>

    </div>

</body>

</html>