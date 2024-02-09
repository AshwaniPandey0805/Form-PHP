<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
</style>
</head>
<body>




    <table>
    <?php
           
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbName = "user";


            $con = new mysqli($servername, $username, $password, $dbName);

            // checking connection
            if($con->connect_error){
                echo "Database not connect".$con->connect_error;
            }else{
                echo "Database connected successfully"."<br>";
            }

            $firstName = $_POST['firstName'];
            // echo $firstName."<br>" ;
            $lastName = $_POST["lastName"];
            // echo $lastName."<br>";
            $email = $_POST["email"];
            // echo $email."<br>";
            $phoneNumber = $_POST["phoneNumber"];
            // echo $phoneNumber."<br>";
            $companyName = $_POST["companyName"];
            // echo $companyName."<br>";
            $address = $_POST["address"];
            // echo $address."<br>";

            $sql = "INSERT INTO userDetail(firstname, lastname, email,phone_number, company, addres)
            VALUES ('$firstName', '$lastName', '$email','$phoneNumber', '$companyName', '$address')
            ";

            $insert = $con->query($sql);



            

            $fetch = "SELECT * FROM userDetail";
            $result = $con->query($fetch);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Company</th><th>Address</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["firstname"] . "</td>";
                    echo "<td>" . $row["lastname"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["company"] . "</td>";
                    echo "<td>" . $row["addres"] . "</td>"; // Note: Typo in the database schema, should be "address" instead of "addres"
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No records found.";
            }

            $con->close();
            ?>
    </table>






   

</body>
</html>
        
