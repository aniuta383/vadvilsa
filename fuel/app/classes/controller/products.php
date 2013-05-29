<?php
class Controller_Products extends Controller_Template
{
    public function action_create(){
        $this->template->title='Create Product';
        $this->template->products = Model_Products::find('all');
        $categories = Model_Categories::find("all");
        foreach ($categories as $row)
        {
            $category[$row['ID']] = $row['name'];
        }
        $fieldset = Fieldset::forge()->add_model('Model_Products')->repopulate();
        $form = $fieldset->form();
        $form->add('submit', '',
            array('type' => 'submit', 'value' => 'Submit', 'class' => 'button-submit'));
        $form->add('categories', 'Categories', array('options' => $category, 'type' => 'checkbox'));
        if($fieldset->validation()->run() == true)
        {
            $fields = $fieldset->validated();
            $products = new Model_Products();
            $products->name = $fields['name'];
            $products->group_id = $fields['group_id'];
            if($products->save())
            {
                $id=$products->ID;

                foreach(Input::post('categories') as $cat)
                {
                    $product_category = new Model_ProductCategories;
                    $product_category->product_id = $id;
                    $product_category->category_id = $cat;
                    $product_category->save();
                }
                \Response::redirect('categories/index/'.$products->ID);
            }
        }
        else
        {
            $this->template->messages = $fieldset->validation()->error();
        }
        $this->template->set('content', $form->build(), false);
    }
    public function action_delete($product_id){
        {
            if(isset($product_id))
            {
                $products = Model_Products::find($product_id);
                $products->delete();
            }
            return \Response::redirect('main/index');
        }
    }
}
