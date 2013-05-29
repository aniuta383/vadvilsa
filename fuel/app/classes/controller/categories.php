<?php
class Controller_Categories extends Controller_Template
{
    public function action_index($category_id = null){

        $this->template->title='UAB VADVILSA';
        $menu=Model_Categories::find('all', array('order_by' => array('parent_id')));
        foreach($menu AS $k)
        $cats = array();
        $subcats = array();
        foreach($menu AS $m){
            $category = array('id' => $m->category_id, 'name' => $m->name, 'descr' => $m->description);
            if($m->parent_ID){
                if(isset($subcats[$m->parent_ID]))
                    $subcats[$m->parent_ID][] = $category;
                else
                    $subcats[$m->parent_ID] = array($category);
            } else {
                $cats[$m->category_id] = $category;
            }
        }
        if (isset ($category_id) && $category)
        {
            $config = array(
                'pagination_url' => Uri::create('categories/index/'.$category_id),
                'total_items'    => Model_Products::query()->related('categories', array('where' => array(array('category_id', '=', $category_id))))->count(),
                'per_page'       => 1,
                'uri_segment'    => 'page',
            );
            $pagination = Pagination::forge('mypagination', $config);
            $products = Model_Products::find('all', array('related'=> array('categories'=>array('where'=>array('category_id'=>$category_id))), 'limit' => $pagination->per_page, 'offset' => $pagination->offset));
        }
        else {
            $config = array(
                'pagination_url' => Uri::create('categories/index'),
                'total_items'    => Model_ProductsCategories::query()->count(),
                'per_page'       => 1,
                'uri_segment'    => 'page',
            );
            $pagination = Pagination::forge('mypagination', $config);
            $products = Model_Products::find('all', array('limit' => $pagination->per_page, 'offset' => $pagination->offset));
        }
        $view  = View::forge('categories');
        $view->set('pager', $pagination->render(), false);
        $view->set('products', $products, false);
        $view->set('cats', $cats, false);
        $view->set('subcats', $subcats, false);
        $this->template->content = $view;
    }
    public function action_delete($category_id){
        {
            if(isset($category_id))
            {
                $categories = Model_Categories::find($category_id);
                if(Model_Categories::find('all', array('where' => array('Parent_ID' => $category_id)))){
                    Session::set_flash('cat_msg', 'v kategorii estj podkategorii!');
                    Response::redirect('admin/categories');
                }

                if(Model_ProductsCategories::find('all', array('where' => array('category_id' => $category_id)))){
                    Session::set_flash('cat_msg', 'estj produkti v kategorii!');
                    Response::redirect('admin/categories');
                }
                $categories->delete();
            }
            return \Response::redirect('admin/categories');
        }
    }
    public function action_edit($category_id){

        $this->template->title='Edit category';
        $this->template->id = Model_Categories::find('all');
        $id= \Model_Categories::find($category_id);
        $fieldset = Fieldset::forge()->add_model('Model_Categories')->populate($id);
        $form     = $fieldset->form();
        $form->add('submit', '',
            array('type' => 'submit', 'value' => 'Save', 'class' => 'submit-button'));


        if($fieldset->validation()->run() == true)
        {
            $fields = $fieldset->validated();
            $id->name     = $fields['name'];
            $id->parent_ID   = $fields['parent_ID'];
            $id->description    = $fields['description'];
            if($id->save())
            {
                \Response::redirect('admin/categories');
            }
        }
        else
        {
            $this->template->messages = $fieldset->validation()->error();
        }
        $this->template->set('content', $form->build(), false);
    }
    public function action_create($category_id = null){
        $this->template->title='Create Category';
        $this->template->categories = Model_Categories::find('all');
        $fieldset = Fieldset::forge()->add_model('Model_Categories')->repopulate();
        $form = $fieldset->form();
        $form->add('submit', '',
            array('type' => 'submit', 'value' => 'Submit', 'class' => 'button-submit'));
        if($fieldset->validation()->run() == true)
        {
            $fields = $fieldset->validated();
            $categories = new Model_Categories();
            $categories->description = $fields['description'];
            $categories->name = $fields['name'];
            $categories->parent_ID = $fields['parent_ID'];
            if($categories->save())
            {
                \Response::redirect('admin/categories');
            }
        }
        else
        {
            $this->template->messages = $fieldset->validation()->error();
        }
        $this->template->set('content', $form->build(), false);
    }
    public function action_view(){
        $this->template->title='UAB VADVILSA';
        $description=Model_Categories::find('all');
        $view  = View::forge('description');
        $view->set('description', $description, false);
        $this->template->content = $view;
    }
}

