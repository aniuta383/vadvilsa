<?php
class Controller_Info extends Controller_Template
{
    public function action_edit(){
        if(!Auth::check())
            Response::redirect('/');
        $this->template->title='Change Info';
        $file = '../public/assets/files/info.txt';
        if(Input::post()){
            file_put_contents($file, Input::post('vadvilsa'));
            return \Response::redirect('main/index');
        }
        $current = file_get_contents($file);
        $view  = View::forge('info');
        $view->set('info', $current, false);
        $this->template->content = $view;
    }
}
