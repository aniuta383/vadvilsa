<?php
class Controller_Cart extends Controller_Template
{
    public function action_view(){
        $products = Session::get('cart');
        if($products === false || empty($products))
        die('net produktov');
        $cart = array();
        $counts = array();
        foreach($products AS $product){
            $counts[$product[0]] = $product[1];
            $cart[] = Model_Products::find($product[0]);
        }
        $view = View::forge('cart');
        $view->set('products', $cart, false);
        $view->set('counts', $counts, false);
        $this->template->title = 'My cart';
        $this->template->content = $view;
    }

    public function action_delete($id){
        Session::delete('cart.'.$id);
        Response::redirect('cart/view');
    }

    public function action_add($id, $count = 1){
        $products = Session::get('cart');
        if($products === false || empty($products)){
            Session::set('cart', array(array($id, $count)));
        } else {
            array_push($products, array($id, $count));
            Session::set('cart', $products);
        }
        Response::redirect('cart/view/');
    }
}
