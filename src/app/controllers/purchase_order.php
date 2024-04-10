<?php
require './app/core/Controller.php';

class purchase_order extends Controller
{
    private $purchaseOrder_model;
    public function __construct()
    {
        $this->loadModel('purchaseOrderModel');
        $this->purchaseOrder_model = new purchaseOrderModel();
    }
    public function index()
    {
        session_start();
        $orderID = 0;
        if(isset($_GET['orderID']))
        {
            $orderID = $_GET['orderID'];
            $orderDetail = $this->purchaseOrder_model -> getOrderDetailByID($orderID);
            $listProduct = $this->purchaseOrder_model ->  getListOrderProduct($orderID);
            $customerInfo = $this->purchaseOrder_model -> getCustomerInfoByOrderID($orderID);
            return $this->view('main_layout', ['page' => 'purchase_order', 'orderDetail' => $orderDetail,
            'customerInfo' => $customerInfo , 'listProduct' => $listProduct]);
        }
        else
        {
            $itemsPerPage = 5;
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
            $sortDate = isset($_GET['sort']) ? $_GET['sort'] : "";
            $Status =  isset($_GET['sl']) ? $_GET['sl'] : "All";
            // if(isset($_SESSION['token']))
            // {
                // $id = $_SESSION['token'];
                $id = 1;
                $listOrder = $this->purchaseOrder_model -> getOrdersByUserIDAndPage($id, $Status, $currentPage, $itemsPerPage, $sortDate);
                foreach ($listOrder as &$Order) {
                    $Order['listProduct'] = $this->purchaseOrder_model ->  getListOrderProduct($Order["id"]);
                }
                unset($Order);
                return $this->view('main_layout', ['page' => 'purchase_order','listOrder' => $listOrder]);
            // }
        }

        // return $this->view('main_layout', ['page' => 'purchase_order']);
    }

    public function cancelOrder()
    {
        $result = false;
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $orderID = $_POST['orderID'];
            $result = $this->purchaseOrder_model-> cancelOrder($orderID);  
        }
        echo json_encode(['success'=>true,'result' => $result]);
    }
    public function show()
    {
    }
}