<?php
class Controller_AttributeSet extends Controller_Template
{
    public function before(){
        if(!Auth::check())
            Response::redirect('/');
    }
    public function action_create($set_id=null){
        $this->template->title='Create Set';
        $this->template->sets = Model_AttributeSets::find('all');
        $fieldset = Fieldset::forge()->add_model('Model_AttributeSets')->repopulate();
        $form = $fieldset->form();
        $form->add('submit', '',
            array('type' => 'submit', 'value' => 'Submit', 'class' => 'button-submit'));
        if($fieldset->validation()->run() == true)
        {
            $fields = $fieldset->validated();
            $sets = new Model_AttributeSets();
            $sets->group_name = $fields['group_name'];
            if($sets->save())

                \Response::redirect('admin/sets');
            }
        else
        {
            $this->template->messages = $fieldset->validation()->error();
        }
        $this->template->set('content', $form->build(), false);
    }
    public function action_delete($set_id){
        {
            if(isset($set_id))
            {
                $sets = Model_AttributeSets::find($set_id);
                $sets->delete();
            }
            return \Response::redirect('admin/sets');
        }
    }
    public function action_edit($set_id){

        $this->template->title='Edit set';
        $this->template->id = Model_AttributeSets::find('all');
        $id= \Model_AttributeSets::find($set_id);
        $fieldset = Fieldset::forge()->add_model('Model_AttributeSets')->populate($id);
        $form     = $fieldset->form();
        $form->add('submit', '',
            array('type' => 'submit', 'value' => 'Save', 'class' => 'submit-button'));


        if($fieldset->validation()->run() == true)
        {
            $fields = $fieldset->validated();
            $id->group_name     = $fields['group_name'];
            if($id->save())
            {
                \Response::redirect('admin/sets');
            }
        }
        else
        {
            $this->template->messages = $fieldset->validation()->error();
        }
        $this->template->set('content', $form->build(), false);
    }
}
