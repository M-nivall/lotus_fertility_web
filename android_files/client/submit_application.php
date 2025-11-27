<?php

include '../../include/connections.php';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Handle incoming POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve POST data
    $userID = $_POST['userID'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $bloodType = $_POST['bloodType'];
    $medication = $_POST['medication'];
    $maritalStatus = $_POST['maritalStatus'];
    $education = $_POST['education'];
    $numChildren = $_POST['numChildren'];
    $moreDetails = $_POST['moreDetails'];
    $role = $_POST['role']; // Role as table name

    // Validate required fields
    if (empty($userID) || empty($height) || empty($weight) || empty($role)) {
        echo json_encode(["status" => 0, "message" => "Required fields are missing"]);
        exit;
    }

    // Allowed roles
    $allowedRoles = ['surrogate_mother', 'egg_donor'];
    if (!in_array($role, $allowedRoles)) {
        echo json_encode(["status" => 0, "message" => "Invalid role"]);
        exit;
    }

    // File upload handling
    $uploadDir = 'uploads/';
    $idImageName = null;
    $medicalImageName = null;
    $photoImageName = null;

    // Function to save file and return its name
    function saveUploadedFile($fileKey, $uploadDir) {
        if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
            $fileName = uniqid() . '_' . basename($_FILES[$fileKey]['name']);
            $targetFilePath = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $targetFilePath)) {
                return $fileName; // Only return the file name
            }
        }
        return null;
    }

    // Save files and get their names
    $idImageName = saveUploadedFile('idImage', $uploadDir);
    $medicalImageName = saveUploadedFile('medicalImage', $uploadDir);
    $photoImageName = saveUploadedFile('photoImage', $uploadDir);

    // Insert based on role
    if ($role === 'surrogate_mother') {
        $query = "INSERT INTO surrogate_mother (surrogate_id, height, weight, blood_type, medication, marital_status, education, num_children, more_details, id_image, medical_image, photo_image) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    } else { // Role is 'donor'
        $query = "INSERT INTO egg_donor (donor_id, height, weight, blood_type, medication, marital_status, education, num_children, more_details, id_image, medical_image, photo_image) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    }

    // Prepare and bind the statement
    $stmt = $con->prepare($query);
    $stmt->bind_param(
        "ssssssssssss", 
        $userID, 
        $height, 
        $weight, 
        $bloodType, 
        $medication, 
        $maritalStatus,
        $education,
        $numChildren, 
        $moreDetails, 
        $idImageName, 
        $medicalImageName, 
        $photoImageName
    );

    if ($stmt->execute()) {
        echo json_encode(["status" => 1, "message" => "Application submitted successfully"]);
    } else {
        echo json_encode(["status" => 0, "message" => "Failed to submit application: " . $con->error]);
    }

    $stmt->close();
}

$con->close();

?>
