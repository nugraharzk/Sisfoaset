<?php

if(!function_exists('is_logged_in'))    
{
    function is_logged_in()
    {
    $CI =& get_instance();
    $is_logged_in = $CI->session->userdata('is_logged_in');
       if(!isset($is_logged_in) || $is_logged_in != true)
       {
        echo 'You don\'t have permission to access this page. <a href="../auth/login">Login</a>';    
        redirect('auth/login');      
       }       
    }
}

