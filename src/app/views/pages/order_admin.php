<?php 
    require './app/includes/formatMoney.php';
    require './app/includes/addOrUpdateQueryParam.php';
?>
<div class="row g-4">
    <div class="col-12">
        <div class="bg-light rounded h-100 pt-3 pb-3 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-success">Search</button>
            </div>
        </div>
    </div>
    <div class="col-12 pt-4">
        <div class="bg-light rounded h-100 p-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="product_info">
                            <th scope="col">
                                <input type="checkbox" name="" id="">
                            </th>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset ($order)) {
                            foreach ($order as $item) {
                                $check = $item["orderStatus"] == "Completed" ? "disabled" : '';
                                echo "<tr id='product-item'>";
                                echo "<th scope='row'>";
                                echo "<input type='checkbox' name=' id='></th>";
                                echo "<td onClick = 'handle(".$item["id"].", event)' class='id_product'> " . $item["id"] . "</td>";
                                echo "<td onClick = 'handle(".$item["id"].", event)'>" . $item["name"] . "</td>";
                                echo "<td onClick = 'handle(".$item["id"].", event)'>" . format_money($item["totalPayment"]) . " VNĐ</td>";
                                echo "<td onClick = 'handle(".$item["id"].", event)'>" . $item["date"] . "</td>";
                                echo "<td onClick = 'handle(".$item["id"].", event)' class='status-".$item["id"]."'>" . $item["orderStatus"] . "</td>";
                                
                                echo "<td> <select ".$check."  onchange='update(". $item["id"] .",this )'  class='mySelect-".$item["id"]."'>
                                            <option  value='Processing'>Processing</option>
                                            <option  value='Delivering'>Delivering</option>
                                            <option  value='Canceled'>Canceled</option>
                                            <option  value='Completed' >Completed</option>
                                        </select>";
                                echo "</td></tr>";
                                echo "<span></span></div></div></td></tr>";
                                echo "<tr >";
                                echo "<td class='empty-".$item["id"]."' colspan = '7'></td>";
                                echo "</tr>";
                            }
                        }

                        ?>

                    </tbody>
                </table>
                <div class="paginatoin-area">
                    <div class="d-flex justify-content-center">
                        <div class="">
                            <ul class="pagination-box pt-xs-20 pb-xs-15">
                                <?php 
                                    $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
                                    
                                    $ordersPerPage = 3;
                                    $num_all_rows = isset($quantity) ? $quantity : 0;
                                    $totalPages = ceil($num_all_rows / $ordersPerPage);
                                    
                                    if($page > 1) {
                                        echo '<li><a href="'. addOrUpdateQueryParam($currentUrl, "page", $page - 1) .'" class="Previous"><i class="fa fa-chevron-left"></i> Previous</a></li>';
                                    }
                                    
                                    if($totalPages > 5){
                                        if($page > 20){
                                            for ($i = $totalPages - 5; $i < $totalPages; $i++) {
                                                        echo '<li class="'.($page == $i ? 'active' : '').'"><a href="'.addOrUpdateQueryParam($currentUrl, "page", $i).'">'.$i.'</a></li>';
                                                    }
                                        }
                                        else if($page > 3){
                                            for ($i = $page - 2; $i <= $page + 2 && $i<$totalPages; $i++) {
                                                echo '<li class="'.($page == $i ? 'active' : '').'"><a href="'.addOrUpdateQueryParam($currentUrl, "page", $i).'">'.$i.'</a></li>';
                                            }
                                        
                                        }else{
                                            for ($i = 1; $i <= 5 && $i<$totalPages; $i++) {
                                                echo '<li class="'.($page == $i ? 'active' : '').'"><a href="'.addOrUpdateQueryParam($currentUrl, "page", $i).'">'.$i.'</a></li>';
                                            }
                                        }
                                    }else{
                                        for ($i = 1; $i <= 5; $i++) {
                                            echo '<li class="'.($page == $i ? 'active' : '').'"><a href="'.addOrUpdateQueryParam($currentUrl, "page", $i).'">'.$i.'</a></li>';
                                        }
                                    }
                                    if($page < $totalPages - 3) {
                                        echo '<li> <a href="'. addOrUpdateQueryParam($currentUrl, "page", $page + 1) .' " class="Next"> Next <i class="fa fa-chevron-right"></i></a> </li>';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
</div>
