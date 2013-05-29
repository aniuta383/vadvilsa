<?php
class Controller_Attribute extends Controller_Template
{
    public function action_create($attribute_id=null){
        if(!Auth::check())
            Response::redirect('/');
        $this->template->title='Create Attribute';
        $this->template->attributes = Model_Attributes::find('all');
        $sets = Model_AttributeSets::find("all");
        foreach ($sets as $roow)
        {
            $set[$roow['set_id']] = $roow['group_name'];
        }
        $fieldset = Fieldset::forge()->add_model('Model_Attributes')->repopulate();
        $form = $fieldset->form();
        $form->add('attribute_sets', 'Attribute Set', array('options' => $set, 'type' => 'checkbox'));
        $form->add('submit', '',
            array('type' => 'submit', 'value' => 'Submit', 'class' => 'button-submit'));
        if($fieldset->validation()->run() == true)
        {
            $fields = $fieldset->validated();
            $attributes = new Model_Attributes();
            $attributes->name = $fields['name'];
            $attributes->type = $fields['type'];
            $attributes->options = $fields['options'];
            if($attributes->save())
            {
                $id=$attributes->attribute_id;
                foreach(Input::post('attribute_sets') as $setty)
                {
                    $attribute_set = new Model_AttributesAndSets();
                    $attribute_set->attribute_id = $id;
                    $attribute_set->set_id = $setty;
                    $attribute_set->save();
                }
                \Response::redirect('/admin/attributes');
            }
        }
        else
        {
            $this->template->messages = $fieldset->validation()->error();
        }
        $this->template->set('content', $form->build(), false);
    }
    public function action_edit($attribute_id){
        if(!Auth::check())
            Response::redirect('/');
        $this->template->title='Edit attribute';
        $this->template->id = Model_Attributes::find('all');
        $id= \Model_Attributes::find($attribute_id);
        $fieldset = Fieldset::forge()->add_model('Model_Attributes')->populate($id);
        $form     = $fieldset->form();
        $sets = Model_AttributeSets::find("all");
        foreach ($sets as $roow)
        {
            $set[$roow['set_id']] = $roow['group_name'];
        }
        $form->add('submit', '',
            array('type' => 'submit', 'value' => 'Save', 'class' => 'submit-button'));
        $form->add('attribute_sets', 'Attribute Set', array('options' => $set, 'type' => 'checkbox'));
        if($fieldset->validation()->run() == true)
        {
            $fields = $fieldset->validated();
            $id->name     = $fields['name'];
            $id->type = $fields['type'];
            $id->options = $fields['options'];
            if($id->save())
            {
                $cats=$id->attribute_id;
                $attribute_sets = Model_AttributesAndSets::find('all', array('where'=>array('attribute_id'=>$attribute_id)));
                foreach($attribute_sets as $attribute)
                {
                    $attribute->delete();
                }
                foreach(Input::post('attribute_sets') as $setty)
                {
                    //var_dump($setty); die;
                    $attribute_sets = new Model_AttributesAndSets();
                    $attribute_sets->attribute_id = $cats;
                    $attribute_sets->set_id = $setty;
                    $attribute_sets->save();
                }
                \Response::redirect('admin/attributes');
            }
        }
        else
        {
            $this->template->messages = $fieldset->validation()->error();
        }
        $this->template->set('content', $form->build(), false);
    }
    public function action_delete($attribute_id){
        {        if(!Auth::check())
            Response::redirect('/');
            if(isset($attribute_id))
            {
                $attributes = Model_Attributes::find($attribute_id);
                $attributes->delete();
                $values = Model_ProductsValue::find('all', array('where' => array('attribute_id' => $attribute_id)));
                foreach($values AS $value)
                $value->delete();
            }
            return \Response::redirect('admin/attributes');
        }
    }
}
