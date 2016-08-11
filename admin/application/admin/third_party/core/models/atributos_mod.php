<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);

/**
 * @author Rodrigo Romero
 * @version 1.0.0
 * 
 *  TODO: LOG
 */
 

class Atributos_mod extends RR_Model {
    var $table    = 'atributos';
    var $atributo = "atributos";
    var $padre_id;
    var $atrib;
	public function __construct() {	   
 		parent::__construct();
        $this->padre_id = $this->params["p"];
        //NOMBRE DEL ATRIBUTO
        $this->atrib    = $this->db->get_where($this->table, array("id"=> $this->padre_id))->row(); 
    }
    
    public function getListado(){
        
        
        $query = $query = $this->get_children($this->padre_id);
        // $this->db->get_where($this->table,array('id >'=>($this->padre_id*10000),"id <"=>(($this->padre_id+1)*10000), 'status >='=>0));
        
        //CONFIG
        $lnk_del   = set_url(array($this->atributo =>'chk_deletea'));
        $lnk_upd   = set_url(array($this->atributo =>'action', 'iu'=>'u'));
        
        $html  = "<a class='ax-modal tip-top icon-trash' href='".$lnk_del."/id/{%id%}' data-original-title='Eliminar' style='margin-right:10px'></a>"; 
		$html .= "<a class='tip-top icon-pencil' href='".$lnk_upd."/id/{%id%}' data-original-title='Editar' style='margin-right:10px'></a>";
        
        $extra[] = array("html" => $html, "pos" => 0);
        $datagrid["columns"][] = array("title" => "", "field" => "", "width" => "46");      
        $datagrid["columns"][] = array("title" => "Nombre", "field" => "nombre");
        $datagrid["columns"][] = array("title" => "Descripcion", "field" => "descripcion");
        
        $datagrid["columns"][] = array("title" => "Activo", "field" => "status", 'format'=>'icon-activo');
        
        $datagrid["rows"]      = $this->datagrid->query_to_rows($query->result(), $datagrid["columns"], $extra, "parent_id",1);

        $filter_data = array('new' => set_url(array($this->atributo =>'action', 'iu'=>'i')),
                            );
        
        $filter = $this->view("filters/".$this->atributo, $filter_data);
        
        $this->breadcrumb->addCrumb($this->atrib->nombre,'');
        $this->breadcrumb->addCrumb('Listado','','current');
         
        $dg = array("datagrid"   => $datagrid,
                    "filters"    => $filter, 
                    'grid_title' => $this->atrib->nombre);
        $grid = $this->datagrid->make($dg);
        return $grid;
    }
    
    
    public function get($top_id=0) {
        if (!empty($top_id))
        {
            $parent = $this->get_one($top_id);
            if (!empty($parent))
            {
                $this->db->like('lineage', $parent['lineage'], 'after');
            }               
        }   

        $query = $this->db->order_by('lineage')->get($this->table);
        return $query;        
    }

    public function get_one($id) {
        $row = $this->db->where('id', $id)
                        ->get($this->table)
                        ->row_array();
        return $row;                
    }
    
    public function get_children($parent_id){       
        $query = $this->db->order_by('lineage')->where('parent_id', $parent_id)->get($this->table);
        return $query; 
    }
    
     public function set_iu(){
        $data_panel['action']    = set_url(array('atributos'=>'do_iu'));
        $data_panel['multilang'] = true;
        if(!empty($this->params['id'])){
            $id = $this->params['id'];
            $data_panel['row']  = $this->db->get_where($this->table,array('id'=>$id))->row();
            $data_panel['json'] = json_decode($data_panel['row']->json);
        }
        
        $this->breadcrumb->addCrumb($this->atrib->nombre, lang_url('atributos/listado/p/'.$this->padre_id));
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
         if($this->form_validation->run('Atributos')==FALSE){
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            $responseType = 'function';
            $function     = 'appendFormMessages';
            $messages     = validation_errors();
            $data = array('success' => $success, 'responseType'=>$responseType, 'messages'=>$messages, 'value'=>$function);
         } else {            
            //ID PARA INSERTAR
			$this->db->select_max('id');
			$query = $this->db->get_where($this->table, array("id >"=>$this->padre_id*10000, "id <" => ($this->padre_id+1)*10000)); 
			$row   = $query->row();
			$newId = (!empty($row->id)) ? $row->id+1 : ($this->padre_id*10000)+1;
            
            $status = 0;            
            if (isset($_POST['status'])) $status = 1;
            
            foreach($this->langs as $row){
				$json["lang"][$row]["nombre"]      = $this->post_lang("nombre", $row);
				$json["lang"][$row]["descripcion"] = $this->post_lang("descripcion", $row);
			}
          
            $json = json_encode($json);
            $values = array ('nombre'      => $this->input->post('nombre_'.$this->langs[0]),
                             'descripcion' => $this->input->post('descripcion_'.$this->langs[0]),
                             'parent_id'   => $this->padre_id,
                             'json'        => $json,
                             'status'      => $status
                             
                             );
            
            
            switch($this->params['iu']) {
                case 'i':
                    $values['id'] = $newId;
                    $this->insert($values);
                    $this->session->set_flashdata('insert_success', 'Registro Agregado Exitosamente');
                    break;
                    
                case 'u':
                    if(isset($this->params["id"]) || empty($this->params["id"])) {
                        $id = $this->params["id"];
                        $this->update($id,$values);
                        $this->session->set_flashdata('insert_success', 'Registro Actualizado Exitosamente');
                    }
            }
            
      
                $success = true;
                $responseType = 'redirect';
                $data    = array('success' =>$success,'responseType'=>$responseType, 'value'=>lang_url('atributos/listado/p/'.$this->padre_id));
          
             
         }
         
         return $data;
    }
    
    
    public function insert($data){
        if(!empty($data['parent_id'])){
            
            $parent = $this->get_one($this->padre_id);
            $data['deep'] = $parent['deep'] + 1;
        }   
        $this->db->insert($this->table, $data);
        $insert_id =  $this->db->insert_id();
        
        $update['lineage'] = (empty($parent['lineage']))? $insert_id : $parent['lineage'].'-'.$insert_id;
        return $this->update($insert_id, $update);
    }
    
    public function update($id, $data) {
        $result = $this->db->where('id', $id)->set($data)->update($this->table);
        return $result;                   
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
    
    private function _makeFile($name){
        $this->db->order_by("nombre, id");
        $this->db->select("id, nombre, padre_id, status, json");
        $query = $this->db->get_where("atributos", array("status >"=>0, "id >" => ($this->padre_id*10000), "id <" => (($this->padre_id+1)*10000)));

		$json = array();
		foreach($query->result() as $row) {
			$json_lang     = json_decode($row->json);
			$json_lang     = json_encode($json_lang->lang);
			$json[] = array("id"=>$row->id."|".$json_lang."|".$row->status);
		}
		$file = json_encode($json);
		$f    = file_put_contents(BASEPATH."../uploads/data/".$name.".json", $file);
        
        return $f;
        
    }
    

    

}