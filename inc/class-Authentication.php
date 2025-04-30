<?php

if (!defined('ABSPATH'))
  exit;

if (!class_exists('Boatrental_Authentication')) {

  class Boatrental_Authentication
  {

    public function __construct()
    {

      add_action('wp_ajax_boatrental_register', array($this, 'boatrental_register'));
      add_action('wp_ajax_nopriv_boatrental_register', array($this, 'boatrental_register'));

      add_action('wp_ajax_boatrental_login', array($this, 'boatrental_login'));
      add_action('wp_ajax_nopriv_boatrental_login', array($this, 'boatrental_login'));


    }


    public function boatrental_register()
    {
      // Check if the form was submitted
      if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm-password'])) {
        // Sanitize form data
        $username = sanitize_user($_POST['username']);
        $email = sanitize_email($_POST['email']);
        $password = sanitize_text_field($_POST['password']);
        $confirm_password = sanitize_text_field($_POST['confirm-password']);

        // Check if passwords match
        if ($password !== $confirm_password) {
          $response = array('success' => false, 'message' => 'Passwords do not match');
        } else {
          // Attempt to register the user
          $user_id = wp_create_user($username, $password, $email);

          if (is_wp_error($user_id)) {
            $response = array('success' => false, 'message' => $user_id->get_error_message());
          } else {
            $response = array('success' => true, 'message' => 'User registered successfully');
          }
        }
      } else {
        $response = array('success' => false, 'message' => 'Invalid form data');
      }

      wp_send_json($response); // send JSON response
    }

    function boatrental_login() {
      $email_username = sanitize_text_field($_POST['email']);
      $password = $_POST['password'];
      $error = array();
    
      if (empty($email_username)) {
        $error['email'] = 'Please enter your email or username';
      }
    
      if (empty($password)) {
        $error['password'] = 'Please enter your password';
      }
    
      if (empty($error)) {
        if (filter_var($email_username, FILTER_VALIDATE_EMAIL)) {
            $user = get_user_by('email', $email_username);
        } else {
            $user = get_user_by('login', $email_username);
        }
    
        if ($user && wp_check_password($password, $user->data->user_pass, $user->ID)) {
            wp_set_auth_cookie($user->ID, true);
            echo json_encode(array('success' => true, 'message' => 'Login successful', 'redirect'=>wp_redirect(home_url())));
        } else {
            if (!$user) {
                $error = 'Invalid email/username';
            } else {
                $error = 'Invalid password';
            }
            echo json_encode(array('success' => false, 'message' => $error));
        }
    } else {
        echo json_encode(array('success' => false, 'errors' => $error));
    }
    
      wp_die();
    }


  public static function is_user_logged_in_check() {
      return is_user_logged_in() ? true : false;
  }
    


  } //end class

}

return new Boatrental_Authentication();