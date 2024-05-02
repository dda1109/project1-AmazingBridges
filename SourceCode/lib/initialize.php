<?php
session_start();
if(!isset($_SESSION['user']) && basename($_SERVER['REQUEST_URI'])!='login.php'){
    redirect_to('login.php'); 
}

function isFormValidated()
{
    global $errors;
    global $images_errors;
    if (isset($images_errors)) {
        return count($errors) == 0 && count($images_errors) == 0;
    }
    return count($errors) == 0;
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function checkFormBridge()
{
    global $errors;
    if (empty($_POST['name'])) {
        $errors['name'] = 'Required.';
    } else {
        $name = test_input($_POST['name']);
        if (!preg_match("/^([a-zA-Z]+?)([-\s'][a-zA-Z]+)*?$/", $name)) {
            $errors['name'] = "Invalid name.";
        } elseif (!isNameUnique($name) && !isset($_POST['id'])) {
            $errors['name'] = "Bridge name already exists.";
        }
    }

    if (!empty($_POST['begin'])) {
        $begin = test_input($_POST['begin']);
        if (!preg_match("/^\d{1,10}( AD| BC)?$/", $begin)) {
            $errors['begin'] = "Invalid year.";
        }
    }

    if (!empty($_POST['end'])) {
        $end = test_input($_POST['end']);
        if (!preg_match("/^\d{1,10}( AD| BC)?$/", $end)) {
            $errors['end'] = "Invalid year.";
        }
    }

    if (empty($_POST['opened'])) {
        $errors['opened'] = 'Required.';
    } else {
        $opened = test_input($_POST['opened']);
        if (!preg_match("/^\d{1,10}( AD| BC)?$/", $opened)) {
            $errors['opened'] = "Invalid year.";
        }
    }

    if (empty($_POST['country'])) {
        $errors['country'] = 'Required.';
    }
    if (empty($_POST['location'])) {
        $errors['location'] = 'Required.';
    }

    if (empty($_POST['length'])) {
        $errors['length'] = 'Required.';
    } elseif (filter_var($_POST['length'], FILTER_VALIDATE_FLOAT) < 0) {
        $errors['length'] = 'Invalid.';
    }

    if (strlen($_POST['height']) != 0) {
        if ($_POST['height'] == 0 || filter_var($_POST['height'], FILTER_VALIDATE_FLOAT) < 0) {
            $errors['height'] = 'Invalid.';
        }
    }
    if (strlen($_POST['clb']) != 0) {
        if ($_POST['clb'] == 0 || filter_var($_POST['clb'], FILTER_VALIDATE_FLOAT) < 0) {
            $errors['clb'] = 'Invalid.';
        }
    }
    if (strlen($_POST['width']) != 0) {
        if ($_POST['width'] == 0 || filter_var($_POST['width'], FILTER_VALIDATE_FLOAT) < 0) {
            $errors['width'] = 'Invalid.';
        }
    }
    if (strlen($_POST['span']) != 0) {
        if ($_POST['span'] == 0 || filter_var($_POST['span'], FILTER_VALIDATE_FLOAT) < 0) {
            $errors['span'] = 'Invalid.';
        }
    }

    if (empty($_POST['description'])) {
        $errors['description'] = 'Required.';
    }

    if (empty($_POST['mapurl'])) {
        $errors['mapurl'] = 'Required.';
    } else {
        $location = test_input($_POST['mapurl']);
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $location)) {
            $errors['mapurl'] = "Invalid URL";
        }
    }
}

function validateUploadImage()
{
    global $images_errors;
    $allowed_image_extension = array("png", "jpg", "jpeg");
    $i = 0;
    foreach ($_FILES['file']['name'] as $imageName) {
        if(empty($imageName)) break;
        $file_extension = pathinfo($imageName, PATHINFO_EXTENSION);
        $size = $_FILES["file"]["size"][$i];
        if (!isImageNameUnique($imageName)) {
            $images_errors[] = "$imageName already exists. ";
        } elseif (!in_array($file_extension, $allowed_image_extension)) {
            $images_errors[] = "$imageName: Invalid image. ";
        } 
        // elseif ($size > 5000000) {
        //     $images_errors[] = "$imageName: Exceed allowed size ";
        // }
        $i++;
    }
}

function checkFormAdmin()
{
    global $errors;
    if (empty($_POST['name'])) {
        $errors[] = 'Required.';
    } else {
        $name = test_input($_POST['name']);
        if (!preg_match("/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/", $name)) {
            $errors['name'] = "Invalid name.";
        }
    }
    if (empty($_POST['email'])) {
        $errors['email'] = 'Required.';
    } else {
        $email = test_input($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format";
        }
    }
    if (empty($_POST['pwd'])) {
        $errors['pwd'] = 'Required.';
    } else {
        $pwd = test_input($_POST['pwd']);
        if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $pwd)) {
            $errors['pwd'] = "Minimum eight characters, at least one letter and one number.";
        }
    }
}

function checkFormCategory()
{
    global $errors;
    if (empty($_POST['name'])) {
        $errors['name'] = 'Required.';
    } else {
        $name = test_input($_POST['name']);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $errors['name'] = "Invalid name.";
        }
    }
}

function checkFormLogin()
{
    global $errors;
    if (empty($_POST['name'])) {
        $errors['name'] = 'Required';
    }
    if (empty($_POST['pwd'])) {
        $errors['pwd'] = 'Required';
    } else {
        checkAdminAuthentication($_POST['name'], $_POST['pwd']);
    }
}

function redirect_to($location)
{
    header("Location: $location");
    exit;
}
