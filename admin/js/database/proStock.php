<?php
include "../../../database/conf.php"; 

// Base SQL query
$sql = "SELECT ps_id, cat_id, scat_id, pro_id, u_id, SUM(qty) as qty, prize, tax, 
       (tax/100 * SUM(qty * prize)) + SUM(qty * prize) as TPrize, date, status 
       FROM pro_stock";

// Apply search filters if any
if (isset($_POST['search'])) {
    $search_value = $_POST['search'];
    $sql .= " WHERE ps_id LIKE '%$search_value%' OR pro_id LIKE '%$search_value%' 
              OR cat_id LIKE '%$search_value%' OR scat_id LIKE '%$search_value%' 
              OR u_id LIKE '%$search_value%' OR qty LIKE '%$search_value%' 
              OR prize LIKE '%$search_value%' OR date LIKE '%$search_value%' 
              OR status LIKE '%$search_value%'";
}

// Apply specific ID filter if any
if (isset($_POST["find"])) {
    $id = $_POST["find"];
    $sql .= " WHERE ps_id = '$id'";
}

// Apply group by
$sql .= " GROUP BY pro_id";

// Apply ordering
if (isset($_POST['order'])) {
    $column = $_POST['order']['columns'];
    $order = $_POST['order']['dirs'];
    $sql .= " ORDER BY `$column` $order";
} else {
    $sql .= " ORDER BY status ASC";
    $order = "ASC";
}

// Apply pagination
$limit_per_page = isset($_POST["Limit_per_page"]) ? $_POST["Limit_per_page"] : 10;
if (isset($_POST["start"]) && $_POST['start'] != -1) {
    $start = $_POST['start'];
    $limit_per_page = $_POST['length'];
    $sql .= " LIMIT $start, $limit_per_page";
} else {
    $start = 0;
    $sql .= " LIMIT $start, $limit_per_page";
}

// Execute the query
$run_query = $conn->query($sql);

if (!$run_query) {
    echo json_encode(["type" => "error", "msg" => "Query failed: " . $conn->error]);
    exit;
}

$count_all_rows = mysqli_num_rows($run_query);
$filtered_rows = mysqli_num_rows($run_query);

// Prepare data for output
$data = [];
$sno = 0;
while ($row = mysqli_fetch_assoc($run_query)) {
    $checked = $row["status"] === "show" ? "checked" : "";
    $sno++;
    $subarray = [];
    $subarray[] = $sno;
    $subarray[] = "<a id='find_id' data-url='js/database/products.php' data-id='{$row["pro_id"]}'>{$row["pro_id"]}</a>";
    $subarray[] = $row["qty"];
    $subarray[] = $row["prize"];
    $subarray[] = $row["date"];
    $subarray[] = '<div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="check" '.$checked.'></div>';
    $subarray[] = "<a class='btn btn-sm mr-1 btn-info material-symbols-outlined' id='EditBtn' data-id='{$row['ps_id']}'>Edit</a><a href='' class='btn btn-sm btn-danger material-symbols-outlined' id='delBtn' data-id='{$row['ps_id']}'>Delete</a>";
    $data[] = $subarray;
}

$col = [];
$col[] = '<th data-by="'.$order.'" data-table-th="pp_id"> <b>#</b> <i class="fas fa-sort float-end text-muted"></i></th>';
$col[] = '<th data-by="'.$order.'" data-table-th="pro_id"> <b>product </b> <i class="fas fa-sort float-end text-muted"></i></th>';
$col[] = '<th data-by="'.$order.'" data-table-th="qty"><b>Total qty</b> <i class="fas fa-sort float-end text-muted"></i></th>';
$col[] = '<th data-by="'.$order.'" data-table-th="prize"><b>Prize</b> <i class="fas fa-sort float-end text-muted"></i></th>';
$col[] = '<th data-by="'.$order.'" data-table-th="date"><b>date</b> <i class="fas fa-sort float-end text-muted"></i></th>';
$col[] = '<th>Action</th>';

$output = [
    'row' => $data,
    'col' => $col,
    'start' => $start,
    'length' => $limit_per_page,
    'recordsTotal' => $count_all_rows,
    'recordsFiltered' => $filtered_rows
];

echo json_encode(["type" => "success", "data" => $output], true);
?>
