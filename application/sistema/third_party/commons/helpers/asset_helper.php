<?php
function frm_select($title, $attributes=array(), $result, $selected, $add="", $join=false, $json_key=array(), $help="",$firstElement=""){
    $CI            =& get_instance();
    $help          = (!empty($help)) ? help_asset($help) : ""; 
    $attribute_str = _parse_asset_html($attributes);
    
    if(!empty($add)){
        $newObject = $CI->ny_functions->arrayToObject($add);
        array_unshift($result, $newObject);
    }
    $options       = "";
    if ($firstElement!="")
    {
        $sel       = ($selected==0) ? "selected" : "";
        $options  .= "<option value='-1' $sel>$firstElement</option>";
    }
    $json_value    = array();
    array_unshift($json_key, "lang");
    
    foreach($result as $row){
        $json_data  = json_decode($row->json);
        foreach($json_key as $r){
            $json_value[$r] = $json_data->$r;
        }
        $json_data = json_encode($json_value);
        $sel       = ($row->id == $selected) ? "selected" : "";
        $value     = ($join) ? $row->id."|".$json_data."|".$row->status : $row->id;
        $options  .= "<option value='$value' $sel>$row->nombre</option>";
    }
    
    $html = "<select $attribute_str>$options</select>";
    return $html;
}

function frm_multiples_radio($result, $attributes=array(), $checked=0){   
    $CI             =& get_instance();   
    $attribute_str  = _parse_asset_html($attributes);     
    //$checked        = ($checked==1 || $checked==TRUE || $checked==="on") ? "checked" : "";        
    
    $html = '';
    foreach($result as $k=>$options) {        
        if (is_array($options)) $options = $CI->rr_functions->arrayToObject($options);
        if(!empty($options->extra_input)) $html_extra = $options->extra_input;
        if($checked==($k+1)){
            $checked        = "checked";
        } else {
            $checked        = "";
        }                
        $html               .= "<label><input type='radio' value='$options->id' $attribute_str  $checked />$options->nombre</label>";
        $html = $html.$html_extra;    
    }

    return $html;
}

function frm_select_multi_trasfer($result, $name, $atributes=array(), $selected = ''){   
    $html = '';
    $CI         =& get_instance();
    $id_left    = $name.'_left';    
    $name_left  = $name.'_left';
    $id_right   = $name.'_right';
    $name_right = $name.'_right[]';
    
    if(isset($atributes['id'])){
        unset($atributes['id']);
    }
    
    $atributes_left  = array('id'=>$id_left);
    $atributes_left  = array_merge($atributes,$atributes_left);
    if(isset($atributes_left['required'])){
        unset($atributes_left['required']);
    }
    $atributes_left  = _parse_asset_html($atributes_left);
    
    if(isset($atributes['required']) && $atributes['required'] ==TRUE){
        if(isset($atributes['class'])){
            $atributes['class'] = $atributes['class'].' required';
        } else {
            $atributes['class'] = 'required';
        }        
    }
    $atributes_right = array('id'=>$id_right);
    $atributes_right  = array_merge($atributes, $atributes_right);
    if(isset($atributes_right['required'])){
        unset($atributes_right['required']);
    }
    
    $atributes_right  = _parse_asset_html($atributes_right);    
    
    $ids = explode(",",$selected);
    
    
    $options_left  = array();
    $options_right = array();
    
    foreach($result as $values_left){ 
        if(in_array($values_left->id,$ids)){
            $options_right[$values_left->id] = $values_left->nombre;
        } else {
            $options_left[$values_left->id] = $values_left->nombre;
        }
    }
    
    $html .= '<div class="span3">';
    $html .= form_multiselect($name_left,$options_left,'', $atributes_left);
    $html .= '</div>';
    $html .= '<div class="span3 btn-box-multiselect">';
    $html .= '<a class="btn btn-primary" href="javascript:void(0)" onclick="change_select_multi_transfer(\''.$id_left.'\',\''.$id_right.'\')">Agregar<i class="icon-chevron-right icon-white"></i></a>';
    $html .= br(1);
    $html .= '<a class="btn btn-danger" href="javascript:void(0)" onclick="change_select_multi_transfer(\''.$id_right.'\',\''.$id_left.'\')"><i class="icon-chevron-left icon-white"></i> Remover</a>';
    $html .= '</div>';
    $html .= '<div class="span3">';
    $html .= form_multiselect($name_right,$options_right,'',$atributes_right);
    $html .= '</div>';
    
    
    return $html;
}