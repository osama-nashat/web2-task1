
<?php 



?>






<html>

<header>

    <meta charset="UTF-8">
    <title>Graduation Book</title>
    <link rel="stylesheet" type="text/css" href="GBook.css">

</header>

<body>
    
        <h1>Graduation Book</h1>

            <?php 

                $handle1 = fopen("usernamefile.txt", "r");
                $handle2 = fopen("messagefile.txt", "r");
                $handle3 = fopen("imagesfile.txt", "r");
                if ($handle1 && $handle2 && $handle3){
                    while (($line1 = fgets($handle1)) !== false &&  ($line2 = fgets($handle2)) !== false && ($line3 = fgets($handle3)) !== false) {
                        // process the line read.

                        echo'<div class="cong-msg">';
                            echo '<img class="cong-img" src="images/'.$line3.'">';
                            echo '<span class="user-name">From : ' . $line1 . '</span>';
                            echo '<span class="user-msg">Message : ' . $line2 . '</span>';
                        echo'</div>';    
                    }

                    fclose($handle1);
                    fclose($handle2);
                    fclose($handle3);
                } else {
                    echo "there is no messages";
                }
            
            
            
            ?>

    

</body>

</html>