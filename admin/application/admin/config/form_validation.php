<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Rodrigo Romero
 * @version 1.0.0
 * @description Validaciones para Cabayada Gen Administrador y Auth Third Party
 */
                       
$config = array(
                 'AuthLogin' => array(
                                    array(
                                            'field' => 'user',
                                            'label' => 'Usuario',
                                            'rules' => 'trim|required|valid_email|xss_clean'
                                         ),
                                    array(
                                            'field' => 'password',
                                            'label' => 'Contraseña',
                                            'rules' => 'trim|required|xss_clean|md5'
                                         ),
                                    ),
                 
                 'Institucional' => array(
                                    array(
                                            'field' => 'nombre_sp',
                                            'label' => 'Nombre',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'descripcion_sp',
                                            'label' => 'Descripcion',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    ),
                 
                 'Configuracion' => array(
                                    array(
                                            'field' => 'valor_sp',
                                            'label' => 'Valor',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'descripcion_sp',
                                            'label' => 'Descripcion',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    ),
                 'Atributos' => array(
                                    array(
                                            'field' => 'nombre_sp',
                                            'label' => 'Nombre',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'descripcion_sp',
                                            'label' => 'Descripcion',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    ),
                  'Admins' => array(
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
                                            'label' => 'Email - Usuario',
                                            'rules' => 'trim|required|valid_email|xss_clean'
                                         ),
                                    array(
                                            'field' => 'password',
                                            'label' => 'Contraseña',
                                            'rules' => 'trim|required|xss_clean|md5'
                                         ),
                                    ),
                 'Casos' => array(
                                    array(
                                            'field' => 'nombre_sp',
                                            'label' => 'Nombre',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'pais_sp',
                                            'label' => 'País',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'resumen_sp',
                                            'label' => 'Resúmen',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'proyecto_sp',
                                            'label' => 'Proyecto',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'cliente_sp',
                                            'label' => 'Cliente',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'descripcion_sp',
                                            'label' => 'Objetivos',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    ),
                 'Videos' => array(
                                    array(
                                            'field' => 'title_sp',
                                            'label' => 'Título',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'vimeo_id_sp',
                                            'label' => 'Vimeo ID',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'resumen_sp',
                                            'label' => 'Resúmen',
                                            'rules' => 'trim|required|xss_clean'
                                         )
                                    ),
                 
                 
               );