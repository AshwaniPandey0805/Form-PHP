<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
                *{
                    margin: 0;
                    padding: 0;
                }

                body{
                    background-color: rgba(0,0,0,0.78);
                    color: gray;
                }


                form {
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
                
                
    </style>
</head>
<body>
    

    <?php 

        if(isset($_POST['update-id'])){
            $id = $_POST['update-id'];

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbName = "user";

            $con = new mysqli($servername, $username, $password, $dbName);

            $update = " SELECT * 
                        FROM userDetail 
                        WHERE id=$id ";
                        
            $result = $con->query($update);

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){

                    echo "
                        <form action='form.php' method='post'>
                        <h1>Update User</h1>
                        <!-- first name and last name -->
                        <div class='userName'>
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
                                <input type='text' name='companyName' placeholder='Compnay' value='".$row['company']."' >
                            </div>
                            <!-- physical address -->
                            <div class='form-control'>
                                <label for='address'>Physical Address</label>
                                <input type='text' name='address' placeholder='Physical Address' value='".$row['addres']."' >
                            </div>
                            
                        </div>
                        <!-- submit button -->
                        <div class='submitBtn'>
                            <input type='submit' name='submit' value='update'>
                        </div>
                    </form>
                    ";

                }
            }
        }else{
            echo "invalid";
        }
    ?>

</body>
</html>