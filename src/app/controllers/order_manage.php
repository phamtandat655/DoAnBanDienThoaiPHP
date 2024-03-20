<?php
require './app/core/Controller.php';

class order_manage extends Controller
{
    private $order_model;
    public function __construct()
    {
        $this->loadModel('OrderModel');
        $this->order_model = new OrderModel();
    }
    public function index()

    {
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $orders = $this->order_model->GetAllOrderByPage($page);
        $quantity = $this->order_model->GetQuantityOrder();
        // $id = $_POST['id_product'];
        $order = $this->order_model->GetAllOrder();
        // $order_detail = $this->order_model->GetDetailOrderProduct($id);
        return $this->view('main_admin_layout', ['page' => 'order_admin', 'order' => $order, 'orders'=> $orders, 'quantity'=> $quantity]);
    }
    public function GetDetailProduct(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
           
            $order_detail = $this->order_model->GetDetailOrderProduct($id);
            
            echo json_encode(['success'=>true, 'order_detail'=> $order_detail]);
        }
    }
    public function UpdateOrderStatus(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $status = $_POST['value'];
           
            $isSuccess = $this->order_model->UpdateStatus($id,$status);
            
            echo json_encode(['success'=>true, 'isSuccess'=> $isSuccess]);
        }
    }
    
    
}
