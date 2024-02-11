<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <form action="" method="post">
            Player 1:
                male <input type="radio" name="gender[1]" value="1">
                female <input type="radio" name="gender[1]" value="2">
            <br>
            Player 2:
                male <input type="radio" name="gender[2]" value="1">
                female <input type="radio" name="gender[2]" value="2">
            <br>
            Player 3:
                male <input type="radio" name="gender[3]" value="1">
                female <input type="radio" name="gender[3]" value="2"> 
            <br>
            <input type="submit" name="submit" value="submit">
            <!-- <button type="submit">submit</button> -->
        </form>

        <?php 
            if(isset($_POST['submit'])){

                if(isset($_POST['gender'])){
                    echo "TRUE";
                }else{
                    echo "FASLE";
                }

            }
        ?>
</body>
</html>