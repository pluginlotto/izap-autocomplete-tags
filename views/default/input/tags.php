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

elgg_register_js('mod/' . GLOBAL_IZAP_AUTOCOMPLEATE_TAGS_PLUGIN . '/vendors/jquery.autocomplete.js', GLOBAL_IZAP_AUTOCOMPLEATE_TAGS_PLUGIN);
elgg_register_css('mod/' . GLOBAL_IZAP_AUTOCOMPLEATE_TAGS_PLUGIN . '/vendors/jquery.autocomplete.css', GLOBAL_IZAP_AUTOCOMPLEATE_TAGS_PLUGIN);

if(!empty($vars['internalid'])) {
  $default_tag_id = $vars['internalid'];
}else {
  $default_tag_id = "izap_autocomplete_tags";
}

$class = "input-tags";
if (isset($vars['class'])) {
  $class = $vars['class'];
}

$disabled = false;
if (isset($vars['disabled'])) {
  $disabled = $vars['disabled'];
}

$tags = "";
if (!empty($vars['value'])) {
  if (is_array($vars['value'])) {
    foreach($vars['value'] as $tag) {
      if (!empty($tags)) {
        $tags .= ", ";
      }
      if (is_string($tag)) {
        $tags .= $tag;
      } else {
        $tags .= $tag->value;
      }
    }
  } else {
    $tags = $vars['value'];
  }
}
$tag_string = autocomplete_tags();
$add_new_tags  = IzapBase::pluginSetting(array(
                'name'=>'autocompletetags',
                'plugin'=>GLOBAL_IZAP_AUTOCOMPLEATE_TAGS_PLUGIN,
                'value'=> 'yes',
                ));

?>
<input type="text" <?php if ($disabled) echo ' disabled="yes" '; ?><?php echo $vars['js']; ?> name="<?php echo $vars['internalname']; ?>" <?php if (isset($default_tag_id)) echo "id=\"{$default_tag_id}\""; ?> value="<?php echo htmlentities($tags, ENT_QUOTES, 'UTF-8'); ?>" class="<?php echo $class; ?>"/>
<?php if($add_new_tags == 'no' && !elgg_is_admin_logged_in()) {
  echo '<em><small>' . elgg_echo('izap_autotags:not_allowed') . '</small></em>';
}?>
<script language="javascript" type="text/javascript">
  $(document).ready(function(){
    $('#<?php echo $default_tag_id ?>').autocomplete([<?php echo $tag_string;?>],
    {
      width: 320,
      max: 4,
      highlight: false,
      matchContains: "word",
      autoFill: true,
      mustMatch: <?php if($add_new_tags !== 'no' || elgg_is_admin_logged_in()) {
  echo 'false';
}else {
  echo 'true';
} ?>,
      multiple: true,
      multipleSeparator: ", ",
      scroll: true,
      scrollHeight: 300,
      formatResult: function(data) {
        var ary = data[0].split('(');
        return ary[0];
      }
    })
  });
</script>