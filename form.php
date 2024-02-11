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
        #redirectButton {
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

        #redirectButton:hover {
            background-color: #45a049;
        }
        button {
        padding: 8px 16px; /* Adjust padding as needed */
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
    }

    /* Hover effect */
    button:hover {
        background-color: #45a049; /* Darker green */
    }

    /* Pressed effect */
    button:active {
        background-color: #3e8e41; /* Even darker green */
    }

    .deleteBtn {
        display: inline-block;
        padding: 8px 16px;
        background-color: #ff4d4d; /* Red color, you can change it as needed */
        color: #fff; /* White text color */
        text-decoration: none; /* Remove underline */
        border-radius: 4px; /* Rounded corners */
        border: none; /* Remove border */
        cursor: pointer; /* Show pointer cursor on hover */
    }

    .deleteBtn:hover {
        background-color: #cc0000; /* Darker red color on hover */
    }
</style>
</head>
<body>

    <h1>User Details</h1>

    <table>
    <?php

        

   

            

            // checking request is POST
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if( empty($_POST['firstName']) && 
                    empty($_POST["lastName"]) && 
                    empty($_POST["email"]) &&
                    empty($_POST["phoneNumber"]) && 
                    empty($_POST["companyName"]) && 
                    empty($_POST["address"]))
                    {

                        header("Location: index.html");

                }else{

                    // validating gender selection
                    if(isset($_POST['submit'])) {


                        if(!isset($_POST["gender"])){
       
                           header("Location: index.html");
                           exit();
                        }else{
                            $genderValue = $_POST["gender"];
                        }
       
                   } 

                    // Getting user data
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

                        if(isset($_POST["gender"])) {
                            
                            // echo $radioVal;
                        } else {
                            echo "Please select a gender.";
                        }
                                    // checking connection

                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbName = "user";
           
                        $con = new mysqli($servername, $username, $password, $dbName);
                        // insert data to the database
                        $sql = "INSERT INTO userDetail(firstname, lastname, gender, email,phone_number, company, addres)
                        VALUES ('$firstName', '$lastName', '$genderValue', '$email','$phoneNumber', '$companyName', '$address')
                        ";
                         if($con->connect_error){
                            echo "Database not connect".$con->connect_error;
                        }else{
                            echo "Database connected successfully"."<br>";
                        }
            

                        $insert = $con->query($sql);    


                        // adding gender column to the database
                        // $sql = "ALTER TABLE userDetail
                        //     ADD COLUMN gender VARCHAR(20) NOT NULL AFTER lastname;
                        // ";

                        // if($con->query($sql) === TRUE){
                        //     echo "Column added";
                        // }else{
                        //     "something went wrong";
                        // }
                        

                        $fetch = "SELECT * FROM userDetail";
                        $result = $con->query($fetch);

                        if ($result->num_rows > 0) {
                            // echo "<table>";
                            echo "<tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Gender</th>
                                    <th>Company</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                    </tr>";
                            while($row = $result->fetch_assoc()) {
                                echo
                                    "<tr>
                                        <td>".$row['id']."</td>
                                        <td>". $row["firstname"] ."</td>
                                        <td>". $row["lastname"] ."</td>
                                        <td>". $row["email"] ."</td>
                                        <td>". $row["phone_number"] ."</td>
                                        <td>". $row["gender"] ."</td>
                                        <td>". $row["company"] ."</td>
                                        <td>". $row["addres"] ."</td>
                                        <td>
                                            <form action='http://localhost/Form/delete.php' method='POST' >
                                                <button type='submit' name='delete-id' value='".$row['id']."'>DELETE</button>
                                            </form>
                                            <form action='http://localhost/Form/update.php' method='POST' >
                                                <button type='submit' name='update-id' value='".$row['id']."'>UPDATE</button>
                                            </form>
                                        </td>
                                        <td></td>
                                    </tr>
                                ";
                            }
                            // echo "</table>";
                        } else {
                            echo "No records found.";
                        }
                        $con->close();
                }
            }
            ?>
                <button id="redirectButton">Add More User</button>
                <script>
                document.getElementById("redirectButton").addEventListener("click", function() {
                    
                    window.location.href = "index.html";
                });
                </script>
    </table>
</body>
</html>
        
