<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);

/**
 * @author Rodrigo Romero
 * @version 1.0.0
 * 
 *  TODO: LOG
 */
 
require_once(BASEPATH."../assets/widgets/uploadManager/UploadManager.php"); 
class videos_mod extends RR_Model {
    var $table    = 'videos';
    var $atributo = "videos";
   
	public function __construct() {	   
 		parent::__construct();        
        $this->module_title = 'Videos';
       
    }
    
    public function getListado(){
        $this->db->order_by('id','DESC');
        $query = $this->db->get_where($this->table,array('status >='=>0));
        
        //CONFIG
        $lnk_del   = set_url(array($this->atributo =>'chk_deletea'));
        $lnk_upd   = set_url(array($this->atributo =>'action', 'iu'=>'u'));
        
        $html  = "<a class='ax-modal tip-top icon-trash' href='".$lnk_del."/id/{%id%}' data-original-title='Eliminar' style='margin-right:10px'></a>"; 
		$html .= "<a class='tip-top icon-pencil' href='".$lnk_upd."/id/{%id%}' data-original-title='Editar' style='margin-right:10px'></a>";
        
        $extra[] = array("html" => $html, "pos" => 0);
        $datagrid["columns"][] = array("title" => "", "field" => "", "width" => "46");      
        $datagrid["columns"][] = array("title" => "Titulo", "field" => "title");
        $datagrid["columns"][] = array("title" => "Vimeo ID", "field" => "video_id");
        $datagrid["columns"][] = array("title" => "Activo", "field" => "status", 'format'=>'icon-activo');
        
        $datagrid["rows"]      = $this->datagrid->query_to_rows($query->result(), $datagrid["columns"], $extra);

        $filter_data = array('new' => set_url(array($this->atributo =>'action', 'iu'=>'i')),
                            );
        
        $filter = $this->view("filters/".$this->atributo, $filter_data);
        
        $this->breadcrumb->addCrumb($this->module_title,'');
        $this->breadcrumb->addCrumb('Listado','','current');
         
        $dg = array("datagrid" => $datagrid,
                    "filters"  => $filter,
                    'grid_title' => $this->module_title);
        $grid = $this->datagrid->make($dg);
        return $grid;
    }
    
     public function set_iu(){
        $data_panel['action']    = set_url(array('videos'=>'do_iu'));
        $data_panel['multilang'] = true;
        
        $this->breadcrumb->addCrumb($this->module_title, lang_url('videos/listado'));
        if(!empty($this->params['id'])) {
            $this->breadcrumb->addCrumb('Editar','','current');    
        } else {
            $this->breadcrumb->addCrumb('Nuevo','','current');
        }
        
        $data_panel['categorias']  =   "";
        $data_panel['etiquetas']   =   "";
  
        if(!empty($this->params['id'])){
            $id = $this->params['id'];
            $data_panel['row']  = $this->db->get_where($this->table,array('id'=>$id))->row();
            $data_panel['json'] = json_decode($data_panel['row']->json);
        }
        
        $panel = $this->view("panels/".$this->atributo, $data_panel);
        return $panel;
    }
    


    public function do_iu(){
         #VALIDO FORM POR PHP
         $success = 'false';
         if($this->form_validation->run('Videos')==FALSE){
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            $responseType = 'function';
            $function     = 'appendFormMessages';
            $messages     = validation_errors();
            $data = array('success' => $success, 'responseType'=>$responseType, 'messages'=>$messages, 'value'=>$function);
         } else {
            
            $status = 0;            
            $destacado = 0;
            if (isset($_POST['status'])) $status = 1;
            if (isset($_POST['destacado'])) $destacado = 1;

            $json = '';

            foreach($this->langs as $row){
				$json["lang"][$row]["title"]        = $this->post_lang("title", $row);
                $json["lang"][$row]["resumen"]      = $this->post_lang("resumen", $row);
                $json["lang"][$row]["vimeo_id"]     = $this->post_lang("vimeo_id", $row);
			}      
          
            
            $json = json_encode($json);
            
            $values = array ('title'        => $this->input->post('title_'.$this->langs[0]),
                             'video_id'     => $this->input->post('vimeo_id_'.$this->langs[0]),
                             'json'         => $json,
                             'destacado'    => $destacado,
                             'status'       => $status,
                             );

            $this->db->update($this->table, array('destacado'=>0));
            switch($this->params['iu']) {
                case 'i':
                    $query = $this->db->insert($this->table, $values);
                    $id    = $this->db->insert_id();
                    $this->session->set_flashdata('insert_success', 'Registro Agregado Exitosamente');
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
                $data    = array('success' =>$success,'responseType'=>$responseType, 'value'=>lang_url('videos/listado'));
            }
             
         }
         
         return $data;
    }
    
    public function chk_deletea(){
       return $this->check_deletea();
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
                $data    = array('success' =>$success,'responseType'=>$responseType, 'value'=>lang_url('videos/listado'));
            }
        }
        return $data;
    }
    

}