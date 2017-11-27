<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_lib {

    public $params;
    public $notif;

    public function _construct($params)
    {
        $this->params=$params;
        $this->CI =& get_instance();
    }

    function send_notification()
    {
       
        //get users
        $this->CI->load->model('m_user');
        $this->CI->load->model('m_notifikasi');
        $users = $this->CI->m_user->get_user_by_level($params['level']);

        //input notification
        foreach($users as $user)
        {
            //build data 
            $data = array(
                'sender_id' => $sender_id,
                'recepient_id' => $user->id,
                'title' => $title,
                'message' => $message,
                'status' => 'sent'
            );
            print_r($data)

            $this->m_notifikasi->input_notifikasi($data);

            return $notif;
        }

        
    }
}