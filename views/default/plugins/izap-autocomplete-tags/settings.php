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
echo elgg_echo('izap_autotags:admin_settings');
$value = $vars['entity']->autocompletetags;
if(!in_array($value, array('yes', 'no'))) {
  $value = 'yes';
}

    echo elgg_view('input/dropdown', array(
    'name' => 'params[autocompletetags]',
    'value' =>$value,
    'options_values' => array(
            'no' => elgg_echo('izap_autotags:no'),
            'yes' => elgg_echo('izap_autotags:yes'),
    ),
    ));


