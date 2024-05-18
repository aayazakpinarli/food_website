    <?php
include "../../../database/conf.php";
if($_POST["action"] == "cards"){
                $f = [];
                $output = "";
                $link = "";



                $q2=$conn->query("SELECT COUNT(*) as pro FROM `product`");
                if($q2){
                    $row = mysqli_fetch_assoc($q2);
                    $res = [
                        "name" => "products",
                        "result" => $row["pro"],
                        "color" => "var(--bs-danger)",
                        "icons" => "fas fa-shopping-basket",
                        "table" => "products.php",
                        "formModalId" => "#productsInsertModal"
                    ];
                    $f[] = $res;


                }

                $q7=$conn->query("SELECT COUNT(*) as pro FROM `pro_stock`");
                if($q7){
                    $row = mysqli_fetch_assoc($q7);
                    $res = [
                        "name" => "product Stock",
                        "result" => $row["pro"],
                        "color" => "var(--bs-orange)",
                        "icons" => "fas fa-store",
                        "table" => "proStock.php",
                        "formModalId" => "#stockInsertModal"
                    ];
                    $f[] = $res;


                }


                foreach ($f as $row){

                $output.='<div  data-title="'.$row["name"].'" data-tbl="'.$row["table"].'" data-form-modal="'.$row["formModalId"].'" class="col-xl-3 col-md-6 mb-4 cards_box " style="cursor: pointer">
                    <div class="card border-left shadow h-100 py-2" style="--i:'.$row["color"].'   ">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            '.$row["name"].'    
                                            
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">'.$row["result"].'</div>
                                </div>
                                <div class="col-auto">
                                    <i class="'.$row["icons"].' fa-2x "></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                $link .= '<div  data-title="'.$row["name"].'" data-tbl="'.$row["table"].'" data-form-modal="'.$row["formModalId"].'" class=" d-flex-center cards_box " style="cursor: pointer">
      
                                <i class="fas '.$row["icons"].' "></i>
                                <a class="dropdown-item" data-url="js/database/'.$row["table"].'">'.$row["name"].'</a>
                            </div>';


                }
                echo json_encode(["type"=>"success" , "data" =>$output, "link"=>$link , "id"=>"table" ] , true);

}
if($_POST["action"] == "charts"){
    $money = [];
    $output = "";
    $q2=$conn->query("SELECT * FROM `cash` WHERE id = (SELECT max(id) FROM cash)");
            
                        $data = mysqli_fetch_assoc($q2);
                        
                        $m = [
                            "name" => "investment",
                            "money" => $data["invetment"],
                            "color" => "var(--bs-warning)",
                            "pre" => ($data["invetment"]/200000) * 100
                        ];
                        $money[] = $m ;
                        $m = [
                            "name" => "Cash in",
                            "money" => $data["cash-in"],
                            "color" => "var(--bs-success)",
                            "pre" => ($data["cash-in"]/100000) * 100
                        ];
                        $money[] = $m ;
                        $m = [
                            "name" => "Cash out",
                            "money" => $data["cash-out"],
                            "color" => "var(--bs-danger)",
                            "pre" => ($data["cash-out"]/10000) * 100
                        ];
                        $money[] = $m ;
                        $m = [
                            "name" => "profit in",
                            "money" => $data["profite"],
                            "color" => "var(--bs-blue)",
                            "pre" => ($data["profite"]/10000) * 100
                            
                        ];
                        $money[] = $m ;
                       
foreach($money as $row){
    $output .='<section>
                  
    <svg class="circle-chart" viewbox="0 0 33.83098862 33.83098862" width="150" height="150" xmlns="http://www.w3.org/2000/svg">
     
      <circle class="circle-chart__background" stroke="#efefef" stroke-width="2" fill="none" cx="16.91549431" cy="16.91549431" r="15.91549431" />
      <circle class="circle-chart__circle circle-chart__circle--negative" stroke="'.$row["color"].'"    
      stroke-width="2" stroke-dasharray="'.$row["pre"].',100" stroke-linecap="round" fill="none" cx="16.91549431" cy="16.91549431" r="15.91549431" />
      <g class="circle-chart__info">
        <text class="circle-chart__percent" x="16.91549431" y="15.5" alignment-baseline="central" text-anchor="middle" font-size="8">'.$row["money"].'</text>
        <text class="circle-chart__subline" x="16.91549431" y="20.5" alignment-baseline="central" text-anchor="middle" font-size="2">'.$row["name"].'</text>
      </g>
    </svg>
  </section>';
}
echo json_encode(["type"=>"success" , "data" =>$output , ] , true);
}