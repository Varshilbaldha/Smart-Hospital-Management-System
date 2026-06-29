<!DOCTYPE html>
<html>

<head>
    <title>Create Account</title>
    <!-- <link rel="stylesheet" href="hospital_registration.css"> -->
    <link rel="stylesheet" href="style5.css">
    <link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="hospital_registration.js"></script>
</head>

<body>



<div class="floating-icons">

    <div class="icon heart">
        <i class="fa-regular fa-heart"></i>
    </div>
    <div class="icon heart1">
        <i class="fa-regular fa-heart"></i>
    </div>
    <div class="icon stethoscope">
        <i class="fa-solid fa-stethoscope"></i>
    </div>

    <div class="icon pulse">
        <i class="fa-solid fa-heart-pulse"></i>
    </div>

    


    <div class="icon hospital">
        <i class="fa-solid fa-hospital"></i>
    </div>

    <div class="icon user">
        <i class="fa-regular fa-user"></i>
    </div>

    <div class="icon plus">
        <i class="fa-solid fa-plus"></i>
    </div>

    <div class="icon clipboard">
        <i class="fa-regular fa-clipboard"></i>
    </div>

    <div class="icon clock">
        <i class="fa-regular fa-clock"></i>
    </div>

    <div class="icon kit">
        <i class="fa-solid fa-briefcase-medical"></i>
    </div>

    <div class="icon syringe">
        <i class="fa-solid fa-syringe"></i>
    </div>
    
     <div class="icon capsules">
        <i class="fa-solid fa-capsules"></i>
    </div>
    <div class="icon microscope">
        <i class="fa-solid fa-microscope"></i>
    </div>
    <div class="icon eye">
        <i class="fa-solid fa-eye"></i>
    </div>
    <div class="icon lungs">
        <i class="fa-solid fa-lungs"></i>
    </div>
    <div class="icon x-ray">
        <i class="fa-solid fa-x-ray"></i>
    </div>

    <div class="icon prescription-bottle-medical">
        <i class="fa-solid fa-prescription-bottle-medical"></i>
    </div>
    <div class="icon virus">
        <i class="fa-solid fa-virus"></i>
    </div>
    <div class="icon bandage">
        <i class="fa-solid fa-bandage"></i>
    </div>
    <div class="icon ambulance">
        <i class="fa-solid fa-ambulance"></i>
    </div>
    <div class="icon temperature-half">
        <i class="fa-solid fa-temperature-half"></i>
    </div>
    <div class="icon bacteria">
        <i class="fa-solid fa-bacteria"></i>
    </div>


    
    


</div>
    <div class="Box1">
        <h2>Enter Your Valid Hospital Details</h2>

        <form method="post" action="send_mail.php" onsubmit="return validation()" enctype="multipart/form-data">

            <br><br>

            <div class="form-group">

                <div class="Basic">
                    <h3 style="margin-left:5px; margin-bottom:10px">Basic Information</h3>

                    <div class="b1">
                        <label for="hname">Hospital Full Name <span style="color:red;">*</span>:</label>
                        <input type="text" id="hname" name="hname" class="input" placeholder="e.g. City Care Hospital"
                            required>
                    </div>

                    <br>

                    <div class="b1">
                        <label for="lino">Registration/Licence No <span style="color:red;">*</span>:</label>
                        <input type="text" id="lino" name="lino" class="input" placeholder="e.g. GJ/AHM/2026/1234"
                            required>
                    </div>  

                    <br>

                    <div class="b1">
                        <label for="htype">Hospital Type <span style="color:red;">*</span>:</label>

                        <select id="htype" name="htype" required>
                            <option value="">-- Select Hospital Type --</option>
                            <option value="government">Government</option>
                            <option value="private">Private</option>
                            <option value="trust">Trust</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <br>
                </div>

                <div class="Contact Information">
                    <h3 style="margin-left:5px; margin-bottom:10px">Contact Information</h3>

                    <div class="b1">
                        <label for="email"> Hospital Email <span style="color:red;">*</span>:</label>
                        <input type="email" id="email" name="email" class="input" required>
                    </div>

                    <br>

                    <div class="b1">
                        <label for="phone">Hospital Phone No. <span style="color:red;">*</span>:</label>
                        <input type="tel" id="phone" name="phone" class="input" required>
                    </div>

                    <br>

                    <div class="b1">
                        <label for="eno">Emergency Number <span style="color:red;">*</span>:</label>
                        <input type="tel" id="eno" name="eno" class="input" required>
                    </div>

                    <br>

                    <div class="b1">
                        <label for="website">Website :</label>
                        <input type="url" id="website" name="website" class="input">
                    </div>

                    <br>
                </div>

                <div class="Address Information">
                    <h3 style="margin-left:5px; margin-bottom:10px">Address Information</h3>

                    <div class="Address">
                        <label for="address1">Address Line 1 <span style="color:red;">*</span>:</label>
                        <input type="text" id="address1" name="address1" class="input" required>
                        <label for="address2">Address Line 2 <span style="color:red;">*</span>:</label>
                        <input type="text" id="address2" name="address2" class="input" required>
                    </div>

                    <br>

                    <div class="b1">
                        <label for="city">City <span style="color:red;">*</span>:</label>
                        <input type="text" id="city" name="city" class="input" placeholder="e.g. Ahmedabad">
                    </div>

                    <br>

                    <div class="b1">
                        <label for="state">State <span style="color:red;">*</span>:</label>
                        <input type="text" id="state" name="state" class="input" placeholder="e.g. Gujarat">
                    </div>

                    <br>

                    <div class="b1">
                        <label for="zip">Zip Code <span style="color:red;">*</span>:</label>
                        <input type="text" id="zip" name="zip" class="input" required>
                    </div>

                    <br>
                </div>

                <div class="Administrator Information">
                    <h3 style="margin-left:5px; margin-bottom:10px">Administrator Information</h3>

                    <div class="b1">
                        <label for="adminname">Full Name <span style="color:red;">*</span>:</label>
                        <input type="text" id="adminname" name="adminname" class="input"
                            placeholder="e.g. Varshil Baldha" required>

                    </div>

                    <br>
                    <div class="b1">
                        <label for="adminusername">Administrator Username <span style="color:red;">*</span>:</label>
                        <input type="text" id="adminusername" name="adminusername" class="input"
                            placeholder="e.g. varshil_baldha23" required>

                    </div>
                    <div class="b1">
                        <label for="adminemail">Administrator Email <span style="color:red;">*</span>:</label>
                        <input type="email" id="adminemail" name="adminemail" class="input" required>
                    </div>
                    <div class="b1">
                        <label for="adminmobile">Administrator Mobile <span style="color:red;">*</span>:</label>
                        <input type="tel" id="adminmobile" name="adminmobile" class="input" required>
                    </div>

                    <div class="Password">
                        <label for="adminpassword">Password <span style="color:red;">*</span>:</label>
                        <input type="password" id="adminpassword" name="adminpassword" class="input"
                            placeholder="Create Strong Password" required>
                    
                        <label for="adminconfirmpassword">Confirm Password <span style="color:red;">*</span>:</label>
                        <input type="password" id="adminconfirmpassword" name="adminconfirmpassword" class="input"
                            placeholder="Re-Enter Password" required>
                    </div>




                </div>
                <div class="License Document">
                    <label for="license_doc"> License Document <span style="color:red;">*</span> </label> <br><br>
                    <input type="file" id="license_doc" name="license_doc" class="input" accept=".pdf,.jpg,.jpeg,.png" required> <br>
                    <small style="color:gray;"> Upload PDF, JPG, JPEG, or PNG (Maximum Size: 200 KB) </small> <br><br>
                    <input type="submit" value="Upload Document" class="submit-button">
                </div>
                <div class="b1">
                    <label for="submit"></label>


                    <input type="submit" value="Submit" class="submit-button">

                </div>
        </form>
    </div>

</body>

</html>