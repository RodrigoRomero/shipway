<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);

/**
 * @author Rodrigo Romero
 * @version 1.0.0
 * 
 *  TODO: LOG
 */
 

class Usuarios_mod extends RR_Model {
    var $atributo = 'usuarios';
    var $table    = 'admin';
    var $id = '';
	public function __construct() {	   
 		parent::__construct();
        $this->module_title = 'Usuarios del Sistema';
        $this->id           = $this->params['id'];
    }
    
    public function getListado(){
        
        $this->db->select('id, CONCAT(nombre," ", apellido) nombre, email, status',false);
        $this->db->order_by('principal','DESC');
        $query = $this->db->get_where($this->table, array('status >='=>0));
        
        //CONFIG
        $lnk_del   = set_url(array($this->atributo =>'chk_deletea'));
        $lnk_upd   = set_url(array($this->atributo =>'action', 'iu'=>'u'));
        $html  = "<a class='ax-modal tip-top icon-trash' href='".$lnk_del."/id/{%id%}' data-original-title='Eliminar' style='margin-right:10px'></a>"; 
		$html .= "<a class='tip-top icon-pencil' href='".$lnk_upd."/id/{%id%}' data-original-title='Editar' style='margin-right:10px'></a>";
        
        $extra[] = array("html" => $html, "pos" => 0);
        $datagrid["columns"][] = array("title" => "", "field" => "", "width" => "46");      
        $datagrid["columns"][] = array("title"=>"Id", "field"=>"id");
        $datagrid["columns"][] = array("title" => "Nombre", "field" => "nombre");
        $datagrid["columns"][] = array("title" => "Email", "field" => "email");
        $datagrid["columns"][] = array("title" => "Status", "field" => "status", 'format'=>'icon-activo');
        
        $datagrid["rows"]      = $this->datagrid->query_to_rows($query->result(), $datagrid["columns"], $extra);

        $filter_data = array('new' => set_url(array($this->atributo =>'action', 'iu'=>'i')),
                            );
        
        $filter = $this->view("filters/".$this->atributo, $filter_data);
        
        $dg = array("datagrid" => $datagrid,
                    "filters"  => $filter,
                    'grid_title' => $this->module_title);
        $grid = $this->datagrid->make($dg);
        return $grid;
    }
    
    public function set_iu($id= NULL){
        $action = set_url(array('usuarios'=>'do_iu'));        
        if(!empty($this->params['id'])){
            $id = $this->params['id'];            
            $row = $this->db->get_where($this->table,array('id'=>$id))->row();
            $row->password = 'ztentaGen';
        }
        
        $this->breadcrumb->addCrumb($this->module_title,lang_url('usuarios/listado'),'');
        if(!empty($this->params['id'])) {
            $this->breadcrumb->addCrumb('Editar','','current');    
        } else {
            $this->breadcrumb->addCrumb('Nuevo','','current');
        }                
        
        $panel = $this->view("panels/".$this->atributo, array('row'=>$row, 'action'=>$action));
        return $panel;
    }
    
    public function do_iu(){
         #VALIDO FORM POR PHP
         $success = 'false';
         if($this->form_validation->run('Admins')==FALSE){
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            $responseType = 'function';
            $function     = 'appendFormMessages';
            $messages     = validation_errors();
            $data = array('success' => $success, 'responseType'=>$responseType, 'messages'=>$messages, 'value'=>$function);
         } else {
            $status = 0;            
            if (isset($_POST['status'])) $status = 1;
            
            $values = array('nombre'     => $this->input->post('nombre',true),
                            'apellido'   => $this->input->post('apellido', true),
                            'email'      => $this->input->post('email',true),
                            'password'   => $this->input->post('password',true),
                            'status'     => $status,
                            'principal'  => 0,
                            'user'       => 'admin'
                           );
            
            switch($this->params['iu']) {
                case 'i':
                    $query = $this->db->insert($this->table, $values);
                    $this->session->set_flashdata('insert_success', 'Registro Insertado Exitosamente');
                    break;
                    
                case 'u':
                    if(isset($this->params["id"]) || empty($this->params["id"])) {
                        $id = $this->params["id"];
                        $this->db->where('id', $id);
				        $query = $this->db->update($this->table, $values);
                        $this->session->set_flashdata('insert_success', 'Registro Actualizado Exitosamente');
                    }
            }
            
            if($query){
                $success = true;
                $responseType = 'redirect';
                
                $data    = array('success' =>$success,'responseType'=>$responseType, 'value'=>lang_url('usuarios/listado'));
            }
             
         }
         
         return $data;
    }
    
    public function chk_deletea(){
        if(!empty($this->id)){
            $mainUser = $this->db->select('principal')->get_where($this->table,array('id'=>$this->id, 'status'=>1))->row();
            if($mainUser->principal==1){
                $data = array('title' => 'Eliminar Usuario',
                              'texto' => 'No es posible eliminar el usuario seleccionado, dado que el mismo es el usuario maestro del sistema.<br/>Si desea eliminarlo por favor contactese con los administradores del sistema, para asignar un nuevo usuario maestro.',
                              'link'  => false,
                             );
            } else {
                $data = array('title' => 'Eliminar Usuario',
                              'texto' => 'Está seguro que desea eliminar este registro?',                              
                              'link'  => set_url(array($this->atributo=>'deletea','id'=>$this->id))
                             );
            }
            $success        = true;
            $responseType   = 'function';
            $html           = $this->view('alerts/modal_dialog',$data);
            $function       = 'open_modal';
            $data = array('success'=>$success, 'responseType'=>$responseType, 'html'=>$html, 'value'=>$function);
            
        }
       return $data;
    }
    
    public function deletea(){
        if(isset($this->params["id"]) || empty($this->params["id"])) {
            $id = $this->params["id"];
            $values = array('status'=>-1);
            $this->db->where('id', $id);
	        $query = $this->db->update($this->table, $values);
            $this->session->set_flashdata('insert_success', 'Registro Eliminado Exitosamente');
            
            if($query){
                $success = true;
                $responseType = 'redirect';                
                $data    = array('success' =>$success,'responseType'=>$responseType, 'value'=>lang_url('atributos/listado/p/'.$this->padre_id));
            }
        }
        return $data;
    }
    

    

}