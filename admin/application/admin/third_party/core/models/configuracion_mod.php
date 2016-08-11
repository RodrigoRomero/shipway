<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);

/**
 * @author Rodrigo Romero
 * @version 1.0.0
 * 
 *  TODO: LOG
 */
 

class Configuracion_mod extends RR_Model {
    var $table    = 'env';
    var $atributo = "configuraciones";
    var $id = '';
	public function __construct() {	   
 		parent::__construct();
        $this->id           = $this->params['id'];
        $this->module_title = 'Configuración del Sistema';
    }
    
    public function getListado(){
        
        $this->db->where('system',0);
        $query = $this->db->get_where($this->table);
        
        //CONFIG
        //$lnk_del   = set_url(array($this->atributo =>'chk_deletea'));
        $lnk_upd   = set_url(array($this->atributo =>'action', 'iu'=>'u'));
        
        //$html  = "<a class='ax-modal tip-top icon-trash' href='".$lnk_del."/id/{%id%}' data-original-title='Eliminar' style='margin-right:10px'></a>"; 
		$html = "<a class='tip-top icon-pencil' href='".$lnk_upd."/id/{%id%}' data-original-title='Editar'></a>";
        
        $extra[] = array("html" => $html, "pos" => 0);
        $datagrid["columns"][] = array("title" => "", "field" => "", "width" => "16");      
        $datagrid["columns"][] = array("title" => "Nombre", "field" => "nombre");
        $datagrid["columns"][] = array("title" => "Descripción", "field" => "descripcion");        
        $datagrid["columns"][] = array("title" => "Activo", "field" => "status", 'format'=>'icon-activo', "width" => "16");
        
        $datagrid["rows"]      = $this->datagrid->query_to_rows($query->result(), $datagrid["columns"], $extra);

        $filter_data = array('new' => set_url(array($this->atributo =>'action', 'iu'=>'i')),
                            );
        
        $filter = ''; //$this->view("filters/".$this->atributo, $filter_data);
        
        $dg = array("datagrid"   => $datagrid,
                    "filters"    => $filter,
                    'grid_title' => $this->module_title);
        $grid = $this->datagrid->make($dg);
        return $grid;
    }
    
     public function set_iu(){
        $data_panel['action'] = set_url(array('configuraciones'=>'do_iu'));
        $data_panel['multilang'] = true;
        if(!empty($this->params['id'])){
            $id = $this->params['id'];
            $data_panel['row']   = $this->db->get_where($this->table,array('id'=>$id))->row();
            $data_panel['valor'] = json_decode($data_panel['row']->valor);
        }
        
        $this->breadcrumb->addCrumb($this->module_title, lang_url('configuraciones/listado'));
            if(!empty($this->params['id'])) {
                $this->breadcrumb->addCrumb('Editar','','current');    
            } else {
                $this->breadcrumb->addCrumb('Nuevo','','current');
            }
        $panel = $this->view("panels/".$this->atributo, $data_panel);
        return $panel;
    }
    
    public function do_iu(){
         #VALIDO FORM POR PHP
         $success = 'false';
         if($this->form_validation->run('Configuracion')==FALSE){
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            $responseType = 'function';
            $function     = 'appendFormMessages';
            $messages     = validation_errors();
            $data = array('success' => $success, 'responseType'=>$responseType, 'messages'=>$messages, 'value'=>$function);
         } else {
            $status = 0;            
            if (isset($_POST['status'])) $status = 1;
            
            foreach($this->langs as $row){
				$json["lang"][$row]["descripcion"] = $this->post_lang("descripcion", $row);
				$json["lang"][$row]["valor"]       = $this->post_lang("valor", $row);
			}
          
            $json = json_encode($json);
            $values = array ('nombre'       => $this->input->post('nombre'),
                             'descripcion'  => $this->input->post('descripcion_'.$this->langs[0]),
                             'valor'        => $json,
                             'status'       => $status
                             );
                              
            if(empty($this->params['id'])){
                $query = $this->db->insert($this->table, $values);
                $this->session->set_flashdata('insert_success', 'Registro Insertado Exitosamente');
            } else {
                $this->db->where('id', $this->id);
				$query = $this->db->update($this->table, $values);
                $this->session->set_flashdata('insert_success', 'Registro Actualizado Exitosamente');
            }
            
            if($query){
                $success = true;
                $responseType = 'redirect';                
                $data    = array('success' =>$success,'responseType'=>$responseType, 'value'=>lang_url('configuraciones/listado'));
            }
             
         }
         
         return $data;
    }
    

    

}