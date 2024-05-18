<?php
session_start();

include "../../../database/conf.php"; 

if (!isset($_SESSION['u_id'])) {
    die(json_encode(["type" => "error", "message" => "User not authenticated."]));
}

$current_user_id = $_SESSION['u_id']; // Get the current user's ID

// Prepare the SQL query to select products belonging to the same market
$sql = "SELECT * FROM `product` WHERE `market_id` = (SELECT `u_id` FROM `register` WHERE `u_id` = {$current_user_id} AND `role_id` = 1)";

// Apply search filters if any
if (isset($_POST['search'])) {
    $search_value = $_POST['search'];
    $sql .= " AND (p_id LIKE '%{$search_value}%' 
                OR cat_id LIKE '%{$search_value}%'
                OR scat_id LIKE '%{$search_value}%'
                OR p_title LIKE '%{$search_value}%'
                OR p_subtitle LIKE '%{$search_value}%'
                OR p_prize LIKE '%{$search_value}%'
                OR p_image LIKE '%{$search_value}%'
                OR status LIKE '%{$search_value}%')";
}

// Apply specific ID filter if any
if (isset($_POST["find"])) {
    $id = $_POST["find"];
    $sql .= " AND p_id = '$id'";
}

// Apply ordering
if (isset($_POST['order'])) {
    $column = $_POST['order']['columns'];
    $order = $_POST['order']['dirs'];
    $sql .= " ORDER BY `{$column}` {$order}";
} else {
    $sql .= " ORDER BY status ASC";
    $order = "ASC";
}

// Apply pagination
if (isset($_POST["Limit_per_page"])) {
    $limit_per_page = $_POST["Limit_per_page"];
} else {
    $limit_per_page = 10;
}

if (isset($_POST["start"])) {
    if ($_POST['start'] != -1) {
        $start = $_POST['start'];
        $limit_per_page = $_POST['length'];
        $sql .= " LIMIT {$start}, {$limit_per_page}";
    }
} else {
    $start = 1;
    $offset = ($start - 1) * $limit_per_page;
    $sql .= " LIMIT {$offset}, {$limit_per_page}";
}

$data = array();
$run_query = $conn->query($sql);

if (!$run_query) {
    die(json_encode(["type" => "error", "message" => "Query execution failed: " . $conn->error]));
}

$count_all_rows = mysqli_num_rows($run_query);
$filtered_rows = $count_all_rows;
$sno = 0;

while ($row = mysqli_fetch_assoc($run_query)) {
    if ($row["status"] == "show") {
        $checked = "checked";
    } else {
        $checked = "";
    }
    $sno++;
    $subarray = array();
    $subarray[] = $sno;
    $subarray[] = $row["p_id"];
    $subarray[] = "<img src='../images/{$row["p_image"]}' width='30px' style='border-radius:50%;' alt='{$row["p_image"]}'>";
    $subarray[] = $row["p_title"];
    $subarray[] = $row["p_prize"];
    $subarray[] = '<div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" name="check" ' . $checked . '>
    </div>';
    $subarray[] = "<a class='btn btn-sm mr-1 btn-info material-symbols-outlined' id='EditBtn' data-id='{$row['p_id']}'>Edit</a>
                   <a href='' class='btn btn-sm btn-danger material-symbols-outlined' id='delBtn' data-id='{$row['p_id']}'>Delete</a>";
    $data[] = $subarray;
}

$col = [];
$col[] = '<th data-by="' . $order . '" data-table-th="id"><b>#</b><i class="fas fa-sort float-end text-muted"></i></th>';
$col[] = '<th data-by="' . $order . '" data-table-th="p_id"><b>id</b><i class="fas fa-sort float-end text-muted"></i></th>';
$col[] = '<th data-by="' . $order . '" data-table-th="p_image"><b>Images</b><i class="fas fa-sort float-end text-muted"></i></th>';
$col[] = '<th data-by="' . $order . '" data-table-th="p_title"><b>Title</b><i class="fas fa-sort float-end text-muted"></i></th>';
$col[] = '<th data-by="' . $order . '" data-table-th="p_prize"><b>Prize</b><i class="fas fa-sort float-end text-muted"></i></th>';
$col[] = '<th data-by="' . $order . '" data-table-th="status"><b>Status</b><i class="fas fa-sort float-end text-muted"></i></th>';
$col[] = '<th>Action</th>';

$output = array(
    'row' => $data,
    'col' => $col,
    'start' => $start,
    'length' => $limit_per_page,
    'recordsTotal' => $count_all_rows,
    'recordsFiltered' => $filtered_rows
);

echo json_encode(["type" => "success", "data" => $output], true);
?>
