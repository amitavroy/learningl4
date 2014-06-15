<?php

class SendmailController extends BaseController {

  //using the master layout
  protected $layout = 'html';

  public function handleMailLogin()
  {
    $this->layout->content = View::make('emails.sendmail-login');
  }

  public function authenticateUserDetails()
  {
    // GlobalHelper::dsm(Input::all(), true);

    // setting the username and password from post data
    $username = Input::get('email');
    $password = Input::get('password');
    $body = View::make('emails.sendmail-body');
    $subject = Input::get('subject');;

    // setting the server, port and encryption
    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
      ->setUsername($username)
      ->setPassword($password);

    // creating the Swift_Mailer instance and pass the config settings
    $mailer = Swift_Mailer::newInstance($transport);

    // configuring the Swift mail instance with all details
    $message = Swift_Message::newInstance($subject)
      ->setFrom(array('amitavroy@gmail.com' => 'Amitav Roy'))
      ->setTo(array('amitav.roy@focalworks.in' => 'Amitav Office'))
      ->setBody($body, 'text/html');
    
    try 
    {
      $mailer->send($message);
      echo 'Mail sent... Enoy.';
    }
    catch (Exception $e)
    {
      die('Error sending email. ' . $e);
    }
  }
}