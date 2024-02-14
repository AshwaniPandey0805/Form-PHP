<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <style>
        body{
            background-color: rgba(0,0,0,0.71);
                    color: white;
        }
        #updateUserBody{
            background-color: rgba(0,0,0,0.78);
                    color: gray;
                }
        
        table {
            width: 100%;
            /* border-collapse: collapse; */
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 4px solid #ddd;
            text-align: center;

        }
        th {
            background-color: #f2f2f2;
            color: black;
            text-align: center;
            font-size: 20px;
            
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

        

        #updateBtn{
            display: inline-block;
            padding: 8px 16px;
            background-color: #4CAF50; /* Green */
            color: #fff; /* White text color */
            text-decoration: none; /* Remove underline */
            border-radius: 4px; /* Rounded corners */
            border: none; /* Remove border */
            cursor: pointer; /* Show pointer cursor on hover */

        }

        #deleteBtn{
            display: inline-block;
            padding: 8px 16px;
            background-color: #ff4d4d; /* Red color, you can change it as needed */
            color: #fff; /* White text color */
            text-decoration: none; /* Remove underline */
            border-radius: 4px; /* Rounded corners */
            border: none; /* Remove border */
            cursor: pointer; /* Show pointer cursor on hover */
        }

        #deleteBtn:hover {
            background-color: #cc0000; /* Darker red color on hover */
        }

        /* update form style */
        #updateForm {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .form-control label {
            display: block;
            margin-bottom: 5px;
        }
        .form-control input[type="text"] {
            width: calc(100% - 10px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .submitBtn {
                    text-align: center;
                }

        .submitBtn button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .submitBtn button:hover {
            background-color: #45a049;
        }
        .genderPreference{
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .actionBtn{
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
        }
        
    </style>
</head>
<body>

    

    <?php
            // submit
            if(isset($_POST['submit']))
            {
                if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    if( empty($_POST['firstName']) && 
                        empty($_POST["lastName"]) && 
                        empty($_POST["email"]) &&
                        empty($_POST["phoneNumber"]) && 
                        empty($_POST["companyName"]) && 
                        empty($_POST["address"]))
                        {
    
                            header("Location: index.html");
    
                    }else
                        {
                        // validating gender selection
                        if(isset($_POST['submit'])) {
                            if(!isset($_POST["gender"])){
                                header("Location: index.html");
                                exit();

                            }else
                            {
                                // Getting user data
                                $genderValue = $_POST["gender"];
                                $firstName = $_POST['firstName'];
                                $lastName = $_POST["lastName"];
                                $email = $_POST["email"];
                                $phoneNumber = $_POST["phoneNumber"];
                                $companyName = $_POST["companyName"];
                                $address = $_POST["address"];
                                
                                // connecting database
                                $con = toConnectDataBase();

                                // createDatabase($con);

                                // create table
                                // createTable($con);
                                
                                // insert data to the database
                                insertDataToDataBase( $con, $firstName, $lastName, $email, $genderValue, $phoneNumber, $companyName, $address);
                                
                                // fetching user details from database
                                fetchUserDetails($con);
                                $con->close();
                            }
            
                        } 
            
                                
                    }
                }
            }

            // update form
            if(isset($_POST['update-id'])){
                $id = $_POST['update-id'];
    
                $con = toConnectDataBase();
    
                $retriveData = " SELECT * 
                            FROM userDetails 
                            WHERE id=$id ";
                            
                $result = $con->query($retriveData);
    
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc())
                    {
    
                        echo "
                        <body id='updateUserBody' >
                            <form action='form.php' method='post' id='updateForm' >
                            <h1>Update User</h1>
                            <!-- first name and last name -->
                            <div class='userName'>
                            <div class='form-control '>
                                <label for='userID'>User ID:</label>
                                <input type='text' name='userID' value='".$row['id']."'  >
                            </div>
                                <div class='form-control'>
                                    <label for='firstName'>First Name:</label>
                                    <input type='text' name='firstName' placeholder='Enter first name' value='".$row['firstname']."' >
                                </div>
                                <div class='form-control'>
                                    <label for='lastName'>Last Name:</label>
                                    <input type='text' name='lastName' placeholder='Enter last name' value='".$row['lastname']."' >
                                </div>
                            </div>
            
                            <!-- form detail -->
                            <div class='userDetail'>
                                <!-- Email -->
                                <div class='form-control'>
                                    <label for='email'>Email:</label>
                                    <input type='text' name='email' placeholder='Enter email' value='".$row['email']."'>
                                </div>
                                <!-- phone Number -->
                                <div class='form-control'>
                                    <label for='phoneNumber'>Phone Number:</label>
                                    <input type='text' name='phoneNumber' placeholder='Phone Number' value='".$row['phone_number']."'>
                                </div>
                                <!-- gender -->
                                <div class='genderPreference'>
                                    
                                        <div>
                                            <label for=''>Gender</label>
                                        </div>
                                        <div class='male'>
                                            <label for='male'>Male</label>
                                            <input type='radio' id='male' name='gender' value='male'>
                                        </div>
                                        <div class='female'>
                                            <label for='female'>Female</label>
                                            <input type='radio' id='Female' name='gender' value='female'>
                                        </div>
                                </div> 
                                <!-- company name -->
                                <div class='form-control'>
                                    <label for='companyName'>Company(if applicable)</label>
                                    <input type='text' name='companyName' placeholder='Compnay' value='".$row['company_name']."' >
                                </div>
                                <!-- physical address -->
                                <div class='form-control'>
                                    <label for='address'>Physical Address</label>
                                    <input type='text' name='address' placeholder='Physical Address' value='".$row['address']."' >
                                </div>
                                
                            </div>
                            <!-- submit button -->
                            <div class='submitBtn'>
                                <input type='submit' name='updateDetail' value='update' id='updateBtn'>
                            </div>
                        </form>
                        </body>
                        ";
    
                    }
                }
            }

            // update 
            if(isset($_POST['updateDetail'])){

                if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    if( empty($_POST['firstName']) && 
                        empty($_POST["lastName"]) && 
                        empty($_POST["email"]) &&
                        empty($_POST["phoneNumber"]) && 
                        empty($_POST["companyName"]) && 
                        empty($_POST["address"]))
                        {
    
                            header("Location: update.php");
    
                    }else{

                            // connecting database
                            $con = toConnectDataBase(); 
                                    
                            $id = $_POST['userID'];
                            $genderValue = $_POST["gender"];
                            $firstName = $_POST['firstName'];
                            $lastName = $_POST["lastName"];
                            $email = $_POST["email"];
                            $phoneNumber = $_POST["phoneNumber"];
                            $companyName = $_POST["companyName"];
                            $address = $_POST["address"];

                            // Update Query    
                            updateUserDetail($con, $firstName, $lastName, $email, $genderValue, $phoneNumber, $companyName, $address, $id);

                            fetchUserDetails($con);
                            
                            $con->close();
                        }
                }
            }

            // delete userDetail
            if(isset($_POST['delete-id'])){
                    $id = $_POST['delete-id'];
                    // connecting database
                    $con = toConnectDataBase();
        
                    toDeleteUserDetail($con,$id);

                    fetchUserDetails($con);

                    $con->close();
    
                }

                // function to connect database

                function toConnectDataBase(){
                    // connectiong data base
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbName = "user";

                    $con = new mysqli($servername, $username, $password , $dbName);

                    if($con->connect_error){
                        echo "Database not connect".$con->connect_error;
                    }else{
                        echo "Database connected successfully"."<br>";
                    }

                    return $con;
                }

                // function to create database
                function createDatabase($con){
                    
                    $dbname = "CREATE DATABASE user";

                    if($con->query($dbname) === TRUE){
                        echo "Database created successfully";
                    }else{
                        echo "Something went wromg while creating database";
                    }
                }

                // function to create database
                function createTable($con){
                    $createTable = "CREATE TABLE userDetails (
                                    id INT AUTO_INCREMENT PRIMARY KEY,
                                    firstname VARCHAR(50) NOT NULL,
                                    lastname VARCHAR(50) NOT NULL,
                                    email VARCHAR(100) NOT NULL,
                                    phone_number VARCHAR(20),
                                    gender ENUM('male', 'female'),
                                    company_name VARCHAR(100),
                                    address VARCHAR(255)
                                    );";

                    if($con->query($createTable) === TRUE){
                        echo "table created";

                    }else{
                        echo "Something went wrong while creating database";
                    }
                }

                // function to insert data to databse

                function insertDataToDataBase($con,
                            $firstName,
                            $lastName,
                            $email,
                            $genderValue,
                            $phoneNumber,
                            $companyName,
                            $address){

                    $sql = "INSERT INTO userDetails(firstname, lastname, gender, email,phone_number, company_name, address)
                            VALUES ('$firstName', '$lastName', '$genderValue', '$email','$phoneNumber', '$companyName', '$address')
                            ";
                    
                     
                    if($con->query($sql) === TRUE){
                        echo "Data inserted SuccessFully";
                    }else{
                        echo "Something went wrong while inserting data to databse";
                    }
                }

                // function to fetch data from the user
                function fetchUserDetails($con){
                    $fetch = "SELECT * FROM userDetails";
                    $result = $con->query($fetch);

                    if ($result->num_rows > 0) {

                        echo "<h1>User Details</h1>";
                        echo "<table>";
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
                                    <td>". $row["company_name"] ."</td>
                                    <td>". $row["address"] ."</td>
                                    <td>
                                        <div class='actionBtn'>
                                            <div>
                                                <form action='http://localhost/Projects/Core-PHP-Form/form.php' method='POST' >
                                                    <button type='submit' name='delete-id' value='".$row['id']."' id='deleteBtn'>DELETE</button>
                                                </form>
                                            </div>
                                            <div>
                                                <form action='http://localhost/Projects/Core-PHP-Form/form.php' method='POST' >
                                                    <button type='submit' name='update-id' value='".$row['id']."' id='updateBtn'>UPDATE</button>
                                                </form>
                                            </div>

                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                            ";
                        }
                        echo "</table>";
                        echo "<button id='redirectButton'>Add More User</button>
                            <script>
                            document.getElementById('redirectButton').addEventListener('click', function() {
                                
                                window.location.href = 'index.html';
                            });
                            </script>";
                        
                    } else {
                        echo "<button id='redirectButton'>Add More User</button>
                            <script>
                            document.getElementById('redirectButton').addEventListener('click', function() {
                                
                                window.location.href = 'index.html';
                            });
                            </script>";
                    }
                }

                // function to delete row form the database
                function toDeleteUserDetail($con, $id){
                    $delete = "DELETE FROM userDetail WHERE id = $id";

                    $con->query($delete);
                }


                // function to update user details
                function updateUserDetail($con, $firstName, $lastName, $email, $genderValue, $phoneNumber, $companyName, $address, $id){

                    $updateID = "UPDATE userDetails 
                                SET firstname = '$firstName', 
                                    lastname = '$lastName',
                                    gender = '$genderValue',
                                    email = '$email',
                                    phone_number = '$phoneNumber',
                                    company_name = '$companyName',
                                    address = '$address'
                                WHERE id = $id";
                    $con->query($updateID);
                }
            ?>
            
</body>
</html>
        
