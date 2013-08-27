<?php return array (
  'package' => 
  array (
    'type' => 'module',
    'name' => 'yntheme',
    'version' => '4.01',
    'path' => 'application/modules/Yntheme',
    'title' => 'YouNet Themes',
    'description' => 'Manage YouNet Themes',
    'author' => 'YouNet Company',
    'callback' => 
    array (
      'class' => 'Engine_Package_Installer_Module',
    ),
    'actions' => 
    array (
      0 => 'install',
      1 => 'upgrade',
      2 => 'refresh',
      3 => 'enable',
      4 => 'disable',
    ),
    'directories' => 
    array (
      0 => 'application/modules/Yntheme',
    ),
    'files' => 
    array (
      0 => 'application/languages/en/yntheme.csv',
    ),
  ),
  'routes' => array(
    'core_changetheme' => array(
      'route' => 'admin/themes/change/*',
      'defaults' => array(
        'module' => 'yntheme',
        'controller' => 'admin-themes',
        'action' => 'change'
      ),
    ),
   ),
); ?>