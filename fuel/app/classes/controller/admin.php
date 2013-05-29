<?php
class Controller_Admin extends Controller_Template
{
    public function before ()
    {
        parent::before();
        if(!Auth::member(100))
        {
            Response::redirect('main/index');
        }
    }
    public function action_redirect(){
        $this->template->title='Admin Panel';
        $view  = View::forge('admin');
        $this->template->content = $view;
    }
    public function action_categories(){
            $categories = Model_Categories::find('all');
            $this->template->title='Manage Categories';
            $view  = View::forge('manage_categories');
            $view->set('categories', $categories, false);
            $this->template->content = $view;
    }
    public function action_products(){
            $products = Model_Products::find('all');
            $this->template->title='Manage Products';
            $view  = View::forge('manage_products');
            $view->set('products',$products, false);
            $this->template->content = $view;
    }
    public function action_sets(){
            $sets = Model_AttributeSets::find('all');
            $this->template->title='Manage Sets';
            $view  = View::forge('manage_sets');
            $view->set('sets',$sets, false);
            $this->template->content = $view;
    }
    public function action_attributes(){
            $attributes = Model_Attributes::find('all');
            $this->template->title='Manage Attributes';
            $view  = View::forge('manage_attributes');
            $view->set('attributes',$attributes, false);
            $this->template->content = $view;
    }
}
