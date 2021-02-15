<?php 

$adminName = 'osama';
$adminPass = 'osama123';

$valid_admin="";


if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $valid_admin = $username == $adminName && $password == $adminPass ;

    if($valid_admin){

        setcookie('adminName',$username,time() + 60*60*24*30);
        setcookie('adminPass',$password,time() + 60*60*24*30);

        header('Location:GBook.php');
    }
}

?>


<html>

<header>

    <meta charset="UTF-8">
    <title>Graduation Book</title>
    <link rel="stylesheet" type="text/css" href="login.css">

</header>

<body>

        <div class="form-container">

            <form action="login.php" method="post" class="login-form">

                <h1>Login</h1>

                <input type="text" name="username" placeholder="Username">

                <input type="password" name="password" placeholder="Password">
                 
                <input type="submit" name="submit" value="login">

            </form>

            <?php 

                if(isset($_POST['submit'])){

                    if(!$valid_admin){
                        echo '<span class="warning">sorry...you are not an admin *</span>';
                       
                    }
                }
    
            ?>

            <a class="guest" href="msg.php">login as guest</a>

        </div>
    

</body>

</html>

