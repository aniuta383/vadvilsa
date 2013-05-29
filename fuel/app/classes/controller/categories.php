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
        if (isset ($category_id))
        {
            $products = Model_Products::find('all', array('related'=> array('categories'=>array('where'=>array('category_id'=>2)))));
        }
        else {
            $products = Model_Products::find('all');
        }
        $view  = View::forge('categories');
        $view->set('products', $products, false);
        $view->set('cats', $cats, false);
        $view->set('subcats',$subcats,false);
        $this->template->content = $view;
    }
    public function action_delete($category_id){
        {
            if(isset($category_id))
            {
                $categories = Model_Categories::find($category_id);
                $categories->delete();
            }
            return \Response::redirect('categories/index');
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
                \Response::redirect('categories/index');
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
                \Response::redirect('categories/index/'.$categories->ID);
            }
        }
        else
        {
            $this->template->messages = $fieldset->validation()->error();
        }
        $this->template->set('content', $form->build(), false);
    }
}

