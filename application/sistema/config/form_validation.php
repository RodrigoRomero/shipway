<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Rodrigo Romero
 * @version 1.0.0
 * @description Validaciones para Cabayada Gen Administrador y Auth Third Party
 */
                       
$config = array('Contacto' => array(
                                    array(
                                            'field' => 'nombre',
                                            'label' => 'Nombre',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                     array(
                                            'field' => 'apellido',
                                            'label' => 'Apellido',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'email',
                                            'label' => 'Email',
                                            'rules' => 'trim|required|valid_email|xss_clean'
                                         ),
                                    array(
                                            'field' => 'mensaje',
                                            'label' => 'Mensaje',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    ),
                'Suscripcion' => array(
                                    array(
                                            'field' => 'frmNltr_email',
                                            'label' => 'Email',
                                            'rules' => 'trim|required|valid_email|xss_clean'
                                         ),
                                    ),
                 
                
               );
               
               