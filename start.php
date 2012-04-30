<?php
/**************************************************
* PluginLotto.com                                 *
* Copyrights (c) 2005-2010. iZAP                  *
* All rights reserved                             *
***************************************************
* @author iZAP Team "<support@izap.in>"
* @link http://www.izap.in/
* @version 1.0
* Under this agreement, No one has rights to sell this script further.
* For more information. Contact "Tarun Jangra<tarun@izap.in>"
* For discussion about corresponding plugins, visit http://www.pluginlotto.com/pg/forums/
* Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
 */

/*
 * define some globals
 */

define('GLOBAL_IZAP_AUTOCOMPLEATE_TAGS_PLUGIN', 'izap-autocomplete-tags');

//Hook the plugin with the system
elgg_register_event_handler('init', 'system', 'izap_autocomplete_tags_init');


/**
 * main init function, that will be hooked
 */
function izap_autocomplete_tags_init() {
  // start plugin
  izap_plugin_init(GLOBAL_IZAP_AUTOCOMPLEATE_TAGS_PLUGIN);
elgg_register_js('izap.autocomplete', 'mod/' . GLOBAL_IZAP_AUTOCOMPLEATE_TAGS_PLUGIN . '/vendors/jquery.autocomplete.js');
elgg_register_css('izap.autocomplete.css' ,  'mod/' . GLOBAL_IZAP_AUTOCOMPLEATE_TAGS_PLUGIN . '/vendors/jquery.autocomplete.css');
}

function autocomplete_tags() {
  $tags = elgg_get_tags(array(
      'limit' => 1000
  ));

  foreach($tags as $key=>$val) {
    $tag[] = $val->tag .' ('.$val->total.')';
  }

  return json_encode($tag);
}
