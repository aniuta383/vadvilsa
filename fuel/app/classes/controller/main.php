<?php
class Controller_Main extends Controller_Template
{
    public function action_index()
    {
        var_dump(mail('filinka@inbox.lv', 'efse', 'fese'));
        $this->template->title='UAB VADVILSA';
        $view  = View::forge('index');
        $this->template->content = $view;
    }
}
