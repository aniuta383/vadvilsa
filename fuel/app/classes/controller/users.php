<?php
class Controller_Users extends Controller_Template
{
    public function action_registration()
    {
        if (Input::post())
        {
            $user_name = Model_Users::find('first', array('where'=>array('username'=>Input::post('username'))));
            $user_email = Model_Users::find('first', array('where'=>array('email'=>Input::post('email'))));
            $error = false;
            if(count($user_name)>0)
            {
                Session::set_flash("error", "There is user with this login");
                $error = true;
            }
            if(count($user_email)>0)
            {
                Session::set_flash("error", "There is user with this e-mail");
                $error = true;
            }
            if(Input::post('password')!=Input::post('password_2'))
                {
                    Session::set_flash("error", "Password doesn't match");
                    $error = true;
                }
            if(!Input::post('username')){   Session::set_flash("error", "ne vveli username");
                $error = true;}
            if(!Input::post('password')){   Session::set_flash("error", "ne vveli pass");
                $error = true;}
            if(!Input::post('email')){   Session::set_flash("error", "ne vveli nail");
                $error = true;}
            if($error == false)
            try {
            {
                Auth::instance()->create_user(
                    Input::post("username"), Input::post("password"), Input::post("email")
                );
                Auth::instance()->update_user(array('name' => Input::post('name'), 'surname'=>Input::post('surname'), 'phone'=>Input::post('phone')), Input::post('username'));
                Session::set_flash("ok", "Registration is completed!");
            }
            } catch(SimpleUserUpdateException $e){

                $error[] = $e->getMessage();

            }
        }
        $this->template->title='Vadvilsa';
        $view  = \View::forge('registration');
        $this->template->content = $view;
    }
        public function action_login()
    {
        if(Input::post()){
            if(Auth::instance()->login())
            {
               Response::redirect('');
            }
            else
            {
                Session::set_flash("error", "Incorrect user name or password!");
            }
        }

        $this->template->title='UAB VADVILSA';
        $view  = \View::forge('login');
        $this->template->content = $view;
    }
    public function action_logout()
    {
        Auth::instance()->logout();
        Response::redirect('/') and die();
    }
}
