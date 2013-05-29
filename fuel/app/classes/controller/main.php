<?php
class Controller_Main extends Controller_Template
{
    public function action_index()
    {
        /*
        //var_dump(mail('igors@c4.lv', 'fesefs', 'sefes'));
       // die;
// Create an instance
        $email = Email::forge();

// Set the from address
        $email->from('filinka@inbox.lv', 'My Name');

// Set the to address
        $email->to('filinka@inbox.lv', 'Anna Guseva');

// Set a subject
        $email->subject('This is the subject');

// Set multiple to addresses

        $email->to(array(
                        'filinka@inbox.lv',
                   ));

// And set the body.
        $email->body('This is my message');

        try
        {
            $email->send();
        }
        catch(\EmailValidationFailedException $e)
        {
            //echo $e; die;
        }
        catch(\EmailSendingFailedException $e)
        {
           // echo $e; die;
        }
*/
        $this->template->title='UAB VADVILSA';
        $view  = View::forge('index');
        $this->template->content = $view;
    }
}
