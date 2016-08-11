<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);

/**
 * @author Rodrigo Romero
 * @version 1.0.0
 * 
 *  TODO: Login Attempts, Restore Password, Update User
 *  LOG
 */
 

class Auth_mod extends RR_Model {    
    
    private $zt_auth_prefs;
    private $max_login_attempts;
    
	public function __construct() {	   
 		parent::__construct();
        $this->load->config('Auth', TRUE);
        $this->_set_auth_prefs();
        $this->_setLoginAttempts();
    }
    
    /**
     * @description Realiza el loguedo del usuario, guardando en session sus preferencias
     * @return array       
     */ 
    
    public function do_login(){
        #VALIDO FORM POR PHP
        $success = 'false';        
        if($this->form_validation->run('AuthLogin')==FALSE){
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            $responseType = 'function';
            $function     = 'appendFormMessages';
            $messages     = validation_errors();
            $data = array('success' => $success, 'responseType'=>$responseType, 'messages'=>$messages, 'value'=>$function);
        } else {
            #VALIDO USUARIO EXISTENTE EN DB
            $table = SISTEMA_NIVEL;
            $user      = $this->input->post('user',true);
            $password  = $this->input->post('password',true);
            
            $query = $this->db->get_where($table,array('email'=>$user,'password'=>$password,'activo'=>1));
            $total = $query->num_rows();
            
            if($total==1){
                #TRAIGO LOS DATOS DEL USUARIO Y LOS GUARDO EN SESSION
                $user = $query->row();
                set_session("id", $user->id, false);
                set_session("nombre", $user->nombre, false);
                set_session("apellido", $user->apellido, false);
                set_session("email", $user->email, false);
                if(SISTEMA_NIVEL != 'admin'){
                    $temporada_vigente = $this->get_atributos('temporadas',true);
                    
                    set_session("temporada", $temporada_vigente, false);
                    set_session("sistema_id", $user->sistema_id, false);
                     
                }
                $success = true;
                $responseType = 'redirect';            
                $data    = array('success' =>$success,'responseType'=>$responseType, 'value'=>lang_url());
            } else {
                $responseType = 'function';
                $function     = 'appendFormMessages';
                $messages     = '<li>Usuario no válido</li>';  
                $data = array('success' => $success, 'responseType'=>$responseType, 'messages'=>$messages, 'value'=>$function);
            };
            
        }
        return $data;        
    }
    
    public function do_logout(){
        $this->Log->setLog(2);
        foreach($this->session->userdata as $key=>$value){
            $name = explode("usr_", $key);
            if (count($name)==2){
                $this->session->unset_userdata($key);
            }
       }
    }
    
    private function _set_auth_prefs(){
        $this->zt_auth_prefs = $this->config->item('zt_auth_prefs','Auth');
    }
    
    private function _setLoginAttempts(){
        $tmp_max_login_attempts = $this->env->getEnv('login_attemps');
        if(!empty($tmp_max_login_attempts)){
            $this->max_login_attempts = $tmp_max_login_attempts;  
        } else {
            $this->max_login_attempts = $this->zt_auth_prefs['max_login_attempts'];
        }
    }
    

}