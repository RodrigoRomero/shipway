<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);

/**
 * @author Rodrigo Romero
 * @version 1.0.0
 * 
 */
 

class videos_mod extends RR_Model {
	public function __construct() {	   
 		parent::__construct();
    }
    

    
    public function getVideoDestacado(){
        $result = $this->db->order_by('id', 'DESC')->get_where('videos',array('status'=>1, 'destacado'=>1))->row();
        return $result;
    }
    

    public function getVideos($id = null){
        if($id){
            $this->db->where('video_id !=',$id);
            $this->db->limit(4);
        }
        $result = $this->db->order_by('id', 'DESC')->get_where('videos',array('status'=>1))->result();
        return $result;
    }

    public function getVideosById($id){
        $result = $this->db->get_where('videos',array('status'=>1, 'video_id'=>$id))->row();
        return $result;
    }    
}