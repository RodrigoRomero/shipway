<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);

/**
 * @author Rodrigo Romero
 * @version 1.0.0
 * 
 */
 

class main_mod extends RR_Model {
	public function __construct() {	   
 		parent::__construct();
    }
    
    public function getCategoriesMenu(){        
        $return = array('casos_de_exito'=>$this->get_children(1)->result());
		return $return;
    }
    
    public function getDestacadosHome(){
        $this->db->like('atributos_id','20001');        
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get_where('casos_de_exito',array('status'=>1))->result();
        return $result;
        
    }
    
    /* 
    public function getItems(){
        $result = $this->db->get_where('porfolios',array('status'=>1))->result();
        shuffle($result);
        return $result;
    }
    
    
    
    public function getSlider(){
        $this->db->like('atributos_id','20003');
        $result = $this->db->get_where('porfolios',array('status'=>1))->result();
        shuffle($result);
        return $result;   
    }
    
    public function getDetails($id){
        $row = $this->db->get_where('porfolios',array('status'=>1, 'id'=>$id))->row();
        return array('data'=>$row, 'total_images'=>$this->getTotalImages($id,'porfolios/original'));
    }
    */
}