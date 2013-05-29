<?php
class Controller_Products extends Controller_Template
{
    public function action_create(){
        $this->template->title='Create Product';
        $this->template->products = Model_Products::find('all');
        $categories = Model_Categories::find("all");
        foreach ($categories as $row)
        {
            $category[$row['category_id']] = $row['name'];
        }
        $sets = Model_AttributeSets::find("all");
        foreach ($sets as $roow)
        {
            if(!Model_AttributesAndSets::find('first', array('where' => array('set_id' => $roow['set_id']))))
            continue;
            $set[$roow['set_id']] = $roow['group_name'];
        }
        $fieldset = Fieldset::forge()->add_model('Model_Products')->repopulate();
        $form = $fieldset->form();
        $form->add('categories', 'Categories', array('options' => $category, 'type' => 'checkbox'));
        $form->add('attribute_sets', 'Attribute Set', array('options' => $set, 'type' => 'checkbox'));
        $form->add('submit', '',
            array('type' => 'submit', 'value' => 'Submit', 'class' => 'button-submit'));
        if($fieldset->validation()->run() == true)
        {
            $fields = $fieldset->validated();
            $products = new Model_Products();
            $products->name = $fields['name'];
            $products->product_price = $fields['product_price'];
            if($products->save())
            {
                $id=$products->product_id;

                foreach(Input::post('categories') as $cat)
                {
                    $product_category = new Model_ProductsCategories();
                    $product_category->product_id = $id;
                    $product_category->category_id = $cat;
                    $product_category->save();
                }
                foreach(Input::post('attribute_sets') as $setty)
                {
                    $product_set = new Model_ProductsSets();
                    $product_set->product_id = $id;
                    $product_set->set_id = $setty;
                    $product_set->save();
                }
                \Response::redirect('products/next/'.$products->product_id);
            }
        }
        else
        {
            $this->template->messages = $fieldset->validation()->error();
        }
        $this->template->set('content', $form->build(), false);
    }

    public function action_next($product_id = null){
        if(!$product_id)
        Response::redirect();

        $product = Model_Products::find($product_id);
        if(!$product)
        Response::redirect();

        if(Input::post()){

            $config = array(
                'new_name' => $product_id,
                'path' => DOCROOT.'assets/img',
                'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
            );

            Upload::process($config);

            if (Upload::is_valid())
            {
                Upload::save();

                $image = Upload::get_files('image');
                Image::load($config['path'].'/'.$product_id.'.'.$image['extension'])->crop_resize(230, 230)->save($config['path'].'/'.$product_id.'_small.'.$image['extension']);
                Image::load($config['path'].'/'.$product_id.'.'.$image['extension'])->resize(500, 500)->save($config['path'].'/'.$product_id.'.'.$image['extension']);
            }

            $product->image = $product_id.'.'.$image['extension'];
            $product->price = Input::post('price');
            $product->save();
            if(is_array(Input::post('attr'))){
                foreach(Input::post('attr') AS $attr => $value){
                    //var_dump($value);die;
                    //var_dump($value); die;
                    if(is_array($value))
                    $value = implode(",", $value);
                    $p = new Model_ProductsValue();
                    $p->product_id = $product_id;
                    $p->attribute_id = $attr;
                    $p->value = $value;
                    $p->save();
                }
            }
            Response::redirect('products/view/'.$product_id);
        }

        $set_id = Model_ProductsSets::find('first', array('where' => array('product_id' => $product->product_id)))->set_id;

        $attributes = Model_Attributes::find('all', array('related' => array('attribute_sets' => array('where' => array('set_id' => $set_id)))));

        $view = View::forge('next', array('attributes' => $attributes));
        $this->template->title = 'Add step 2';
        $this->template->content = $view;

    }
    public function action_enext($product_id){
        if(!$product_id)
            Response::redirect('/');

        $product = Model_Products::find($product_id);
        if(!$product)
            Response::redirect('/');

        $set_id = Model_ProductsSets::find('first', array('where' => array('product_id' => $product->product_id)))->set_id;

        $attributes = Model_Attributes::find('all', array('related' => array('attribute_sets' => array('where' => array('set_id' => $set_id)))));
        $values = Model_ProductsValue::find('all', array('where'=>array('product_id'=>$product_id)));

        if(Input::post()){

            $config = array(
                'new_name' => $product_id,
                'path' => DOCROOT.'assets/img',
                'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
            );

            Upload::process($config);

            if (Upload::is_valid())
            {
                File::delete($config['path'].'/'.$product->image);
                File::delete($config['path'].'/'.str_replace('.', '_small.', $product->image));
                Upload::save();

                $image = Upload::get_files('image');
                Image::load($config['path'].'/'.$product_id.'.'.$image['extension'])->crop_resize(230, 230)->save($config['path'].'/'.$product_id.'_small.'.$image['extension']);
                Image::load($config['path'].'/'.$product_id.'.'.$image['extension'])->resize(500, 500)->save($config['path'].'/'.$product_id.'.'.$image['extension']);
                $product->image = $product_id.'.'.$image['extension'];
            }

            $product->price = Input::post('price');
            $product->save();

            //$old_values =
            //foreach($values AS $value){
              //  $value->delete();
            //}

            foreach(Input::post('attr') AS $attr => $value){
                //var_dump($value);die;
                //var_dump($value); die;
                if(is_array($value))
                    $value = implode(",", $value);
                //var_dump($attr); die;
                $p = Model_ProductsValue::find('first', array('where' => array('attribute_id' => $attr, 'product_id' => $product_id)));
                //$p->product_id = $product_id;
                //$p->attribute_id = $attr;
                $p->value = $value;
                $p->save();
            }
            Response::redirect('products/view/'.$product_id);
        }

        $vals = array();
        foreach($values AS $v){
            $vals[$v->attribute_id] = $v->value;
        }
        $view = View::forge('enext', array('attributes' => $attributes));
        $view->set('vals',$vals,false);
        $this->template->title='Next Step';
        $this->template->content=$view;
    }
    public function action_edit($product_id){

        $this->template->title='Edit product';
        $this->template->id = Model_Products::find('all');
        $id= \Model_Products::find($product_id);
        $fieldset = Fieldset::forge()->add_model('Model_Products')->populate($id);
        $form     = $fieldset->form();
        $categories = Model_Categories::find("all");
        foreach ($categories as $row)
        {
            $category[$row['category_id']] = $row['name'];
        }
        $form->add('submit', '',
            array('type' => 'submit', 'value' => 'Save', 'class' => 'submit-button'));
        $form->add('categories', 'Categories', array('options' => $category, 'type' => 'checkbox'));
        if($fieldset->validation()->run() == true)
        {
            $fields = $fieldset->validated();
            $id->name     = $fields['name'];
            $id->product_price = $fields['product_price'];
            if($id->save())
            {
                    $cats=$id->product_id;
                    foreach(Input::post('categories') as $cat)
                    {
                        $products = Model_ProductsCategories::find('all', array('where'=>array('product_id'=>$product_id)));
                        foreach($products as $prod)
                    {
                        $prod->delete();
                    }
                        $product_category = new Model_ProductsCategories;
                        $product_category->product_id = $cats;
                        $product_category->category_id = $cat;
                        $product_category->save();
                    }
                \Response::redirect('products/enext/'.$product_id);
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
                if($products->image){
                    $path = DOCROOT.'assets/img';
                    File::delete($path.'/'.$products->image);
                    File::delete($path.'/'.str_replace('.', '_small.', $products->image));
                }
                $products->delete();
            }
            return \Response::redirect('admin/products');
        }
    }
    public function action_view($product_id){
        if (!isset ($product_id))
            return \Response::redirect('categories/index');

        $product = Model_Products::find($product_id);
        $values = Model_ProductsValue::find('all', array('related' => 'attributes', 'where' => array('product_id' => $product_id)));
        $view  = View::forge('products');
        $view->set('product', $product, false);
        $view->set('attr', $values, false);
        $this->template->title = $product['name'];
        $this->template->content = $view;
    }
}
