<?php
class Controller_Main extends Controller_Template
{
    public function action_index()
    {
        $this->template->title='UAB VADVILSA';
        $view  = View::forge('index');
        $this->template->content = $view;
    }

}
