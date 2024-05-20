<?php
include '../../../database/conf.php';
include "AdminLoginCheck.php";

// Sanitize and validate user inputs
$p_id = (isset($_POST["pID"]) && $_POST["pID"] != "") ? mysqli_real_escape_string($conn, $_POST["pID"]) : "";
$title = (isset($_POST["pTitle"]) && $_POST["pTitle"] != "") ? mysqli_real_escape_string($conn, $_POST["pTitle"]) : "";
$prize = (isset($_POST["pPrize"]) && $_POST["pPrize"] != "") ? mysqli_real_escape_string($conn, $_POST["pPrize"]) : "";
$discPrice = (isset($_POST["discPrice"]) && $_POST["discPrice"] != "") ? mysqli_real_escape_string($conn, $_POST["discPrice"]) : "";
$desc = (isset($_POST["pDesc"]) && $_POST["pDesc"] != "") ? mysqli_real_escape_string($conn, $_POST["pDesc"]) : "";
$qty = (isset($_POST["qty"]) && $_POST["qty"] != "") ? mysqli_real_escape_string($conn, $_POST["qty"]) : "";
$status = (isset($_POST["status"]) && $_POST["status"] != "") ? mysqli_real_escape_string($conn, $_POST["status"]) : "active";

// Assume session contains user information
$u_id = isset($_SESSION['u_id']) ? $_SESSION['u_id'] : "";

if ($prize != "" && $title != "" && $qty != "") {
    // Generate a unique identifier for the product
    $newP_id = uniqid('p_');

    if (isset($_FILES["pImg"])) {
        $img_name = $_FILES["pImg"]["name"];
        $img_type = $_FILES["pImg"]["type"];
        $tmp_name = $_FILES["pImg"]["tmp_name"];
        $img_explode = explode('.', $img_name);
        $img_ext = end($img_explode);
        $allowed_extensions = ['png', 'jpeg', 'jpg', "svg"];

        if (in_array($img_ext, $allowed_extensions) === true) {
            // Generate a unique filename for the image
            $img = uniqid('img_') . '.' . $img_ext;

            if (move_uploaded_file($tmp_name, "../../../images/" . $img)) {
                if ($_POST["action"] == "insert") {
                    // Prepare the SQL statement
                    $stmt = $conn->prepare("INSERT INTO `product` (`p_id`, `u_id`, `p_title`, `p_prize`, `p_image`, `market_id`, `discPrice`, `qty`, `status`, `p_desc`)
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                    // Bind the parameters to the statement
                    $stmt->bind_param("ssssssssss", $newP_id, $u_id, $title, $prize, $img, $u_id, $discPrice, $qty, $status, $desc);

                    // Execute the statement
                    if ($stmt->execute()) {
                        $data = array(
                            "type" => "success",
                            "msg" => "Your product was successfully inserted."
                        );
                    } else {
                        $data = array(
                            "type" => "error",
                            "msg" => "Something went wrong: " . $stmt->error
                        );
                    }

                    // Close the statement
                    $stmt->close();
                }

                if ($_POST["action"] == "update") {
                    // Prepare the SQL statement
                    $stmt = $conn->prepare("UPDATE `product` SET `u_id` = ?, `p_title` = ?, `p_prize` = ?,
                                            `p_image` = ?, `market_id` = ?, `discPrice` = ?, `qty` = ?, `status` = ?, `p_desc` = ?
                                            WHERE `p_id` = ?");

                    // Bind the parameters to the statement
                    $stmt->bind_param("ssssssssss", $u_id, $title, $prize, $img, $u_id, $discPrice, $qty, $status, $desc, $p_id);

                    // Execute the statement
                    if ($stmt->execute()) {
                        $data = array(
                            "type" => "success",
                            "msg" => "Your product was updated."
                        );
                    } else {
                        $data = array(
                            "type" => "error",
                            "msg" => "Sorry, the update query failed: " . $stmt->error
                        );
                    }

                    // Close the statement
                    $stmt->close();
                }
            } else {
                $data = array(
                    "type" => "error",
                    "msg" => "Cannot upload your image."
                );
            }
        } else {
            $data = array(
                "type" => "error",
                "msg" => "Select only image files."
            );
        }
    } else {
        $data = array(
            "type" => "error",
            "msg" => "Please select an image."
        );
    }
} else {
    $data = array(
        "type" => "error",
        "msg" => "All fields are required."
    );
}

echo json_encode($data, true);
?>