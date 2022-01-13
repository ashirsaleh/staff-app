<?php
require_once 'includes/header.php';
if (isset($_POST['create_doctor'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $date_of_birth  = date('Y-m-d', strtotime($_POST['date_of_birth']));
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $region = $_POST['region'];
    $zip_code = $_POST['zip_code'];
    $phone_number = $_POST['phone_number'];
    $avatar = $_FILES['avatar']['name'];
    $tempo_name = $_FILES['avatar']['tmp_name'];
    $folder = "assets/img/" . $avatar;
    $short_biography = $_POST['short_biography'];
    $status = $_POST['status'];

    if (
        empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['username']) || empty($_POST['email'])
        || empty($_POST['password']) || empty($_POST['confirm_password']) || empty($_POST['gender'])
        || empty($_POST['status']) || empty($_POST['date_of_birth'])
    ) {
        $_SESSION['error'] = 'Please Fill All Required Fields <span class="text-danger">*</span>';
        // die('cant be empty');
    } else {



        $sql = 'SELECT * FROM `doctors` WHERE `email` = ?';
        $prepare = $dbconn->prepare($sql);
        $prepare->execute([$email]);
        $result = $prepare->fetch(PDO::FETCH_ASSOC);
        if ($prepare->rowCount() < 1) {
            if ($password == $confirm_password) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $confirm_password = password_hash($confirm_password, PASSWORD_DEFAULT);
                $validate_avatar = array('jpg', 'png', 'jpng');
                $pathinfo = pathinfo($avatar, PATHINFO_EXTENSION);
                if (empty($avatar) || in_array($pathinfo, $validate_avatar)) {
                    if (move_uploaded_file($tempo_name, $folder)) {
                        $sql = 'INSERT INTO `doctors`(`fname`, `lname`, `username`, `email`, `password`, `confirm_password`, 
                     `date_of_birth`, `gender`, `address`, `country`, `city`, `region`, `zip_code`,
                      `phone_number`, `avatar`, `short_biography`, `status`) VALUE(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )';
                        $statement = $dbconn->prepare($sql);
                        $statement->execute([
                            $fname, $lname, $username, $email, $password, $confirm_password, $date_of_birth,
                            $gender, $address, $country, $city, $region, $zip_code, $phone_number, $folder,
                            $short_biography, $status
                        ]);
                        if ($statement) {
                            $_SESSION['success'] = 'Doctor Has Been Added Successfully';
                            header('location: doctors.php');
                        } else {
                            $_SESSION['error'] = ' Doctor Coud\'nt Added';
                        }
                    } else {
                        $_SESSION['error'] = 'Please Upload Your Profile Picture';
                    }
                } else {
                    $_SESSION['error'] = 'Please Upload an Image Or Required Image';
                }
            } else {
                $_SESSION['error'] = 'Password Did Not Match';
            }
        } else {
            $_SESSION['error'] = 'User Email Found';
        }
    }
}
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong>
                    <?php echo $_SESSION['success'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php } ?>
                <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed!</strong>
                    <?php echo $_SESSION['error'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php } ?>
                <h4 class="page-title">Add Doctor</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2 has-validation">
                <form method="POST" action="add-doctor.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group is-valid">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="fname" type="text"
                                    value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" name="lname" type="text"
                                    value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Username <span class="text-danger">*</span></label>
                                <input class="form-control" name="username" type="text"
                                    value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" name="email" type="email"
                                    value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" name="password" type="password"
                                    value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input class="form-control" name="confirm_password" type="password"
                                    value="<?php echo isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of Birth <span class="text-danger">*</span></label>
                                <div class="cal-icon">
                                    <input type="text" name="date_of_birth" class="form-control datetimepicker"
                                        value="<?php echo isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : '' ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group gender-select">
                                <label class="gen-label">Gender: <span class="text-danger">*</span></label>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="gender" class="form-check-input"
                                            <?php if (isset($gender) && $gender == "Male") echo "checked"; ?>
                                            value="Male">Male
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="gender" class="form-check-input"
                                            <?php if (isset($gender) && $gender == "Female") echo "checked"; ?>
                                            value="Female">Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control "
                                            value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select class="form-control select" name="country"
                                            value="<?php echo isset($_POST['country']) ? $_POST['country'] : '' ?>">
                                            <option>USA</option>
                                            <option>United Kingdom</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" name="city" class="form-control"
                                            value="<?php echo isset($_POST['city']) ? $_POST['city'] : '' ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label>State/Province</label>
                                        <select class="form-control select" name="region"
                                            value="<?php echo isset($_POST['region']) ? $_POST['region'] : '' ?>">
                                            <option>California</option>
                                            <option>Alaska</option>
                                            <option>Alabama</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label>Postal Code</label>
                                        <input type="text" name="zip_code" class="form-control"
                                            value="<?php echo isset($_POST['zip_code']) ? $_POST['zip_code'] : '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone </label>
                                <input class="form-control" name="phone_number" type="number"
                                    value="<?php echo isset($_POST['phone_number']) ? $_POST['phone_number'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Avatar</label>
                                <div class="profile-upload">
                                    <div class="upload-img">
                                        <img alt="" src="assets/img/user.jpg">
                                    </div>
                                    <div class="upload-input">
                                        <input type="file" name="avatar" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Short Biography</label>
                        <textarea class="form-control" name="short_biography" rows="3" cols="30">
                            <?php
                            if (isset($_POST['short_biography'])) {
                                echo htmlentities($_POST['short_biography']);
                            }
                            ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label class="display-block">Status <span class="text-danger">*</span></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="doctor_active"
                                <?php if (isset($status) && $status == "Active") echo "checked"; ?> value="Active">
                            <label class="form-check-label" for="doctor_active">
                                Active
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="doctor_inactive"
                                <?php if (isset($status) && $status == "Inactive") echo "checked"; ?> value="Inactive">
                            <label class="form-check-label" for="doctor_inactive">
                                Inactive
                            </label>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" value="submit" name="create_doctor">Create
                            Doctor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require 'includes/footer.php'; ?>