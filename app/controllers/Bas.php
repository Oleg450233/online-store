<?php
class Bas extends Controller{

    public function index(){
        $data=[];
        $cart=$this->model('BasModel');
        if(isset($_POST['item_id']))
            $cart->addToCart($_POST['item_id']);
        if(isset($_POST['delete']))
            $cart->deleteSession();
        if(isset($_POST['del_id']))
            $cart->deleteOneIdSession($_POST['del_id']);
        if(!$cart->issetSession())
            $data['empty']='Пустая корзина';
        else {
            $products = $this->model('Products');
            $data['product'] = $products->getProductsCart($cart->getSession());
        }
        $this->view('bas/index', $data);
    }

}
