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
class casos_mod extends RR_Model {
    var $table    = 'casos_de_exito';
    var $atributo = "casos_de_exito";
   
	public function __construct() {	   
 		parent::__construct();        
        $this->module_title = 'Casos de Éxito';
        $this->load->model("atributos_mod", "Atributo");
       
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
        $datagrid["columns"][] = array("title" => "Cliente", "field" => "json", 'json'=>'lang->sp->cliente');
        $datagrid["columns"][] = array("title" => "Nombre", "field" => "nombre");
        $datagrid["columns"][] = array("title" => "Resúmen", "field" => "resumen");
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
        $data_panel['action']    = set_url(array('casos_de_exito'=>'do_iu'));
        $data_panel['multilang'] = true;
        
        $this->breadcrumb->addCrumb($this->module_title, lang_url('casos_de_exito/listado'));
        if(!empty($this->params['id'])) {
            $this->breadcrumb->addCrumb('Editar','','current');    
        } else {
            $this->breadcrumb->addCrumb('Nuevo','','current');
        }
        
        $data_panel['categorias']  =   $this->Atributo->get_children(1)->result();
        $data_panel['etiquetas']   =   $this->Atributo->get_children(2)->result();
  
        if(!empty($this->params['id'])){
            $id = $this->params['id'];
            $data_panel['row']  = $this->db->get_where($this->table,array('id'=>$id))->row();
            $data_panel['json'] = json_decode($data_panel['row']->json);
        }
        
        $data_panel['img_home']     = $this->env->getEnv('img_home');        
        $data_panel['img_porfolio'] = $this->env->getEnv('img_porfolio');
        
        $panel = $this->view("panels/".$this->atributo, $data_panel);
        return $panel;
    }
    
    public function do_iu(){
         #VALIDO FORM POR PHP
         $success = 'false';
         if($this->form_validation->run('Casos')==FALSE){
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            $responseType = 'function';
            $function     = 'appendFormMessages';
            $messages     = validation_errors();
            $data = array('success' => $success, 'responseType'=>$responseType, 'messages'=>$messages, 'value'=>$function);
         } else {
            $status = 0;            
            if (isset($_POST['status'])) $status = 1;            
            foreach($this->langs as $row){
				$json["lang"][$row]["nombre"]       = $this->post_lang("nombre", $row);
                $json["lang"][$row]["pais"]         = $this->post_lang("pais", $row);
                $json["lang"][$row]["resumen"]      = $this->post_lang("resumen", $row);
                $json["lang"][$row]["proyecto"]     = $this->post_lang("proyecto", $row);
                $json["lang"][$row]["cliente"]      = $this->post_lang("cliente", $row);
                $json["lang"][$row]["descripcion"]  = $this->post_lang("descripcion", $row);
                
                foreach($_POST as $k=>$v){
                    $tmp_arr = explode('_',$k);
                    if(in_array('imagen',$tmp_arr) && count($tmp_arr)==4){
                        $json["lang"][$row]["pie_imagen_".$tmp_arr[2]]  = $this->post_lang("pie_imagen_".$tmp_arr[2], $row);
                    }
                }
			}      
          
            $atributos_ids = array();
            if(isset($_POST['categorias_right'])){
                foreach($_POST['categorias_right'] as $k => $v){   
                    $atributos_ids[] = $v;
                    $categoria = $this->Atributo->get_one($v);
                    $json['categorias'][] = array('id'=>$categoria['id'], 'value'=>$categoria['json']);
                }   
            }
            
            if(isset($_POST['etiquetas_right'])){
                foreach($_POST['etiquetas_right'] as $k => $v){   
                    $atributos_ids[] = $v;
                    $etiquetas = $this->Atributo->get_one($v);
                    $json['etiquetas'][] = array('id'=>$etiquetas['id'], 'value'=>$etiquetas['json']);
                }   
            }
            
            $json = json_encode($json);
            $atributos_ids = implode(",",$atributos_ids);
            
            $values = array ('nombre'       => $this->input->post('nombre_'.$this->langs[0]),
                             'resumen'      => $this->input->post('resumen_'.$this->langs[0]),
                             'json'         => $json,
                             'atributos_id' => $atributos_ids,
                             'status'       => $status,
                             );

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
                $data    = array('success' =>$success,'responseType'=>$responseType, 'value'=>lang_url('casos_de_exito/listado'));
            }
             
         }
         
         $up = new UploadManager();        
         $resize = $up->resize($id, BASEPATH."../assets/widgets/uploadManager/");
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
                $data    = array('success' =>$success,'responseType'=>$responseType, 'value'=>lang_url('atributos/listado/p/'.$this->padre_id));
            }
        }
        return $data;
    }
    

}