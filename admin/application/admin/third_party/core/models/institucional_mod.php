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
class Institucional_mod extends RR_Model {
    var $table    = 'institucional';
    var $atributo = "institucional";
	public function __construct() {	   
 		parent::__construct();
    }
    
    public function getListado(){
        $query = $this->db->get_where($this->table);
        
        //CONFIG
        //$lnk_del   = set_url(array($this->atributo =>'chk_deletea'));
        $lnk_upd   = set_url(array($this->atributo =>'action', 'iu'=>'u'));
        
        //$html  = "<a class='ax-modal tip-top icon-trash' href='".$lnk_del."/id/{%id%}' data-original-title='Eliminar' style='margin-right:10px'></a>"; 
		$html = "<a class='tip-top icon-pencil' href='".$lnk_upd."/id/{%id%}' data-original-title='Editar' style='margin-right:10px'></a>";
        
        $extra[] = array("html" => $html, "pos" => 0);
        $datagrid["columns"][] = array("title" => "", "field" => "", "width" => "46");      
        $datagrid["columns"][] = array("title" => "Nombre", "field" => "nombre", "width" => "150");
        $datagrid["columns"][] = array("title" => "Descripcion", "field" => "descripcion");
        $datagrid["columns"][] = array("title" => "Activo", "field" => "status", 'format'=>'icon-activo');
        
        $datagrid["rows"]      = $this->datagrid->query_to_rows($query->result(), $datagrid["columns"], $extra);

        $filter_data = array('new' => set_url(array($this->atributo =>'action', 'iu'=>'i')),
                            );
        
        $filter = ''; //$this->view("filters/".$this->atributo, $filter_data);
        
        $dg = array("datagrid" => $datagrid,
                    "filters"  => $filter);
        $grid = $this->datagrid->make($dg);
        return $grid;
    }
    
     public function set_iu(){
        $data_panel['action'] = set_url(array('institucional'=>'do_iu'));
        $data_panel['multilang'] = true;
        if(!empty($this->params['id'])){
            $id = $this->params['id'];
            $data_panel['row'] = $this->db->get_where($this->table,array('id'=>$id))->row();
            $data_panel['json'] = json_decode($data_panel['row']->json);
            
            #SET UPLOAD IMAGENES
            switch($id){
                case 'me':
                    $data_panel['img_institucional'] = json_decode($this->env->getEnv('img_bio'));
                    break;
                
                case 'el-estudio':
                    $data_panel['img_institucional'] = json_decode($this->env->getEnv('img_estudio'));
                    break;
                   
            }
            
        }
        
        $panel = $this->view("panels/".$this->atributo, $data_panel);
        return $panel;
    }
    
    public function do_iu(){
         #VALIDO FORM POR PHP
         $success = 'false';
         if($this->form_validation->run('Institucional')==FALSE){
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            $responseType = 'function';
            $function     = 'appendFormMessages';
            $messages     = validation_errors();
            $data = array('success' => $success, 'responseType'=>$responseType, 'messages'=>$messages, 'value'=>$function);
         } else {
            $activo = 0;            
            if (isset($_POST['activo'])) $activo = 1;
            
            foreach($this->langs as $row){
				$json["lang"][$row]["nombre"]      = $this->post_lang("nombre", $row);
				$json["lang"][$row]["descripcion"] = $this->post_lang("descripcion", $row);
                if(isset($this->params['id']) && $this->params['id']=='me'){
                    $json["lang"][$row]["cargo"]      = $this->post_lang("cargo", $row);
				    $json["lang"][$row]["titulo"] = $this->post_lang("titulo", $row);
                }
			}
            
            $json = json_encode($json);
            $values = array ('nombre'      => $this->input->post('nombre_'.$this->langs[0]),
                             'descripcion' => $this->input->post('descripcion_'.$this->langs[0]),
                             'json'        => $json,
                             );
            
            switch($this->params['iu']) {
                case 'i':
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
                $data    = array('success' =>$success,'responseType'=>$responseType, 'value'=>lang_url('institucional/listado'));
            }
             
         }
         
         $up = new UploadManager();        
         $resize = $up->resize($id, BASEPATH."../assets/widgets/uploadManager/");
         return $data;
    }
    

    

}