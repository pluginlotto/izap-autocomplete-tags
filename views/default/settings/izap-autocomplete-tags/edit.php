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
?>

<select name="params[autocompletetags]">
  <option value="no" <?php if($vars['entity']->autocompletetags != 'yes'){ echo "selected"; } ?>><?php echo elgg_echo('izap_autotags:no');?></option>
  <option value="yes" <?php if($vars['entity']->autocompletetags == 'yes'){ echo "selected"; } ?>><?php echo elgg_echo('izap_autotags:yes');?></option>
</select>