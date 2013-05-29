<?php
class Controller_Account extends Controller_Template
{
    public function action_index(){
        $id = Auth::instance()->get_user_id();
        Response::redirect('user'.$id[1]);
    }
    public function action_view(){
        if(Auth::check()){
        $userT = Auth::get_user_id();
        $id = $userT[1];
        if(!Auth::check())
            Response::redirect('/');
        is_null($id) and Response::redirect('/');
        $user = Model_Users::find($id);
        is_null($user) and Response::redirect('/');
        $d = unserialize($user['profile_fields']);
        $data = array();
        $data = $user;
        $data['name'] = $d['name'];
        $data['surname'] = $d['surname'];
        $data['phone']=$d['phone'];
        $data['group'] = Auth::group()->get_name($user['group']);
        $my_id = Auth::instance()->get_user_id();
        $data['my_profile'] = ($my_id[1] == $id);
        $this->template->content = View::forge('view')->set('data', $data);
        $this->template->title = $user['username'];
        }
        else {
            Response::redirect('');
        }

    }
    public function action_edit(){
        if(!Auth::check())
            Response::redirect('/');
        $errors = array();
        $data = array();
        $auth = Auth::instance();
        if(Input::method() == 'POST'){
            $data['email'] = Input::post('email');
            $data['name'] = Input::post('name');
            $data['surname'] = Input::post('surname');
            $data['phone'] = Input::post('phone');
            if(empty($data['name']))
                $errors[] = "Please enter your name";
            if(empty($data['surname']))
                $errors[] = "Please enter your surname";
            if(empty($data['phone']))
                $errors[] = "Please enter your phone";
            if(empty($data['email']))
                $errors[] = "Please enter your e-mail";
            if(Input::post('password_old')){
                if(Input::post('password_new') != Input::post('password_2')){
                    $errors[] = "Passwords do not match";
                } else {
                    try {
                        if(!$auth->change_password(Input::post('password_old'), Input::post('password_new'), $auth->get_screen_name()))
                            $errors[] = "You have entered wrong old password";

                    } catch(SimpleUserUpdateException $e){
                        $errors[] = $e->getMessage();
                    }
                }
            }
            if(!count($errors)){
                try {
                    $auth->update_user(array('email' => $data['email'], 'name' => $data['name'], 'surname' => $data['surname'], 'phone' => $data['phone']));
                } catch(SimpleUserUpdateException $e){
                    $errors[] = $e->getMessage();
                }
            }
        } else {
            $data['email'] = $auth->get_email();
            $data['name'] = $auth->get_profile_fields('name');
            $data['surname'] = $auth->get_profile_fields('surname');
            $data['phone'] = $auth->get_profile_fields('phone');
        }
        $this->template->content = View::forge('edit')->set('data', $data)->set('errors', $errors);
        $this->template->title = 'Edit account';
    }
    public function action_delete(){
        $userT = Auth::get_user_id();
        $id = $userT[1];
        if(((!Auth::member(100)) && (!Auth::member(1))) || is_null($id))
            Response::redirect('/');
        $user = Model_Users::find($id);
        $user->delete();
        Response::redirect('/');
    }
}
