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



function izap_autocomplete_tags_init() {
  if(!get_plugin_setting('autocompletetags', 'izap-autocomplete-tags')) {
    set_plugin_setting('autocompletetags', 'yes', 'izap-autocomplete-tags');
  }
  extend_view('metatags', 'izap-autocomplete-tags/js');
  extend_view('css', 'izap-autocomplete-tags/css');
}

function autocomplete_tags() {
  $tags = get_tags(0,9999);

  foreach($tags as $key=>$val) {
    $tag[] = '"' . $val->tag .' ('.$val->total.')'. '"';
  }

  $string = implode(', ', $tag);

  return $string;
}
register_elgg_event_handler('init', 'system', 'izap_autocomplete_tags_init');
