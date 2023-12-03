<?php
// Include config file
require_once "_php/config.php";
 
// Define variables and initialize with empty values
$email = $password = $confirm_password = $ph_name = $location = $contact = "";
$email_err = $password_err = $confirm_password_err = $ph_name_err = $location_err  = $contact_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate email
if (empty(trim($_POST["email"]))) {
    $email_err = "Please enter an email.";
} elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
    $email_err = "Invalid email format.";
} else {
    $param_email = trim($_POST["email"]);

    // Check if email already exists
    $sql_check_email = "SELECT pharm_id FROM pharm_accounts WHERE pharm_email = ?";
    if ($stmt_check_email = mysqli_prepare($link, $sql_check_email)) {
        mysqli_stmt_bind_param($stmt_check_email, "s", $param_email);
        if (mysqli_stmt_execute($stmt_check_email)) {
            mysqli_stmt_store_result($stmt_check_email);
            if (mysqli_stmt_num_rows($stmt_check_email) == 1) {
                $email_err = "This email is already taken.";
            } else {
                $email = $param_email;
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
        mysqli_stmt_close($stmt_check_email);
    }
}

    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Validate Pharmacy Name
    if (empty(trim($_POST["ph_name"]))) {
        $ph_name_err = "Please enter a Pharmacy Name.";
    } else {
        $ph_name = trim($_POST["ph_name"]);
        // Check length
        if (strlen($ph_name) > 50) {
            $ph_name_err = "Pharmacy Name must be 50 characters or less.";
        } else {
            // Check for trailing or leading spaces
            if (trim($ph_name) !== $ph_name) {
                $ph_name_err = "Input unavailable, please try again.";
            } else {
                // Check for allowed characters (alphanumeric, punctuations, spaces, hyphens)
                if (!preg_match('/^[a-zA-Z0-9\s\-.,ñÑ]+$/u', $ph_name)) {
                    $ph_name_err = "Pharmacy Name can only contain alphanumeric characters, spaces, hyphens, and punctuation.";
                }
            }
        }
    }

    // Validate Pharmacy Location
    if (empty(trim($_POST["location"]))) {
        $location_err = "Please enter a Pharmacy Location.";
    } else {
        $location = trim($_POST["location"]);
        // Check length
        if (mb_strlen($location) > 50) {
            $location_err = "Input unavailable, please try again.";
        } else {
            // Check for trailing or leading spaces
            if (trim($location) !== $location) {
                $location_err = "Input unavailable, please try again.";
            } else {
                // Check for allowed characters (alphanumeric, punctuations, spaces, hyphens, and specific characters)
                if (!preg_match('/^[a-zA-Z0-9\s\-.,ñÑ()]+$/u', $location)) {
                    $location_err = "Input unavailable, please try again.";
                }
            }
        }
    }

    // Validate Pharmacy Contact
    if (empty(trim($_POST["contact"]))) {
        $contact_err = "Please enter a Pharmacy Contact.";
    } else {
        $contact = trim($_POST["contact"]);
        // Check length
        if (mb_strlen($contact) > 50) {
            $contact_err = "Input unavailable, please try again.";
        } else {
            // Check for trailing or leading spaces
            if (trim($contact) !== $contact) {
                $contact_err = "Input unavailable, please try again.";
            } else {
                // Check for allowed characters (alphanumeric, punctuations, spaces, hyphens, and specific characters)
                if (!preg_match('/^[a-zA-Z0-9\s\-.,ñÑ()]+$/u', $contact)) {
                    $contact_err = "Input unavailable, please try again.";
                }
            }
        }
    }


    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($confirm_password_err)){
    
        // Prepare an insert statement
        $sql = "INSERT INTO pharm_accounts (pharm_email, pharm_pass, pharm_name, pharm_loc, pharm_contact) VALUES (?, ?, ?, ?, ?)";
            
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_email, $param_password, $param_ph_name, $param_loc, $param_contact);
            
            // Set parameters
            $param_username = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_ph_name = $ph_name;
            $param_loc = $location;
            $param_contact = $contact;
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: index.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <!-- Reg form container -->
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <!-- Email field -->
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>

            <!-- Password field -->
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>

            <!-- Password confirmation -->
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>

            <!-- Pharmacy Name field -->
            <div class="form-group">
                <label>Pharmacy Name</label>
                <input type="text" name="ph_name" class="form-control <?php echo (!empty($ph_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ph_name; ?>">
                <span class="invalid-feedback"><?php echo $ph_name_err; ?></span>
            </div>

            <!-- Pharmacy Location field -->
            <div class="form-group">
                <label>Pharmacy Location</label>
                <input type="text" name="location" class="form-control <?php echo (!empty($location_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $location; ?>">
                <span class="invalid-feedback"><?php echo $location_err; ?></span>
            </div>

            <!-- Pharmacy contact field -->
            <div class="form-group">
                <label>Contact</label>
                <input type="text" name="contact" class="form-control <?php echo (!empty($contact_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contact; ?>">
                <span class="invalid-feedback"><?php echo $contact_err; ?></span>
            </div>

            <!-- Submit/Reset buttons -->
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="/pharm/pharm_login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>