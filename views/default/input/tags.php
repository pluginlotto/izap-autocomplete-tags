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

elgg_load_css('izap.autocomplete.css');
//elgg_load_js('izap.autocomplete');

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

if ($disabled)$disab= 'disabled="yes" ';
echo izapBase::input('text',array('input_title'=> '' ,
                                         'internalname'=> $vars['internalname'] ,
                                         'value'=>htmlentities($tags, ENT_QUOTES, 'UTF-8'),
                                         'id'=> $default_tag_id,
                                         'class'=>'ui-autocomplete-input',
                                         $vars['js'],
                                         $disab
                                 )
     );
 ?>

<?php if($add_new_tags == 'no' && !elgg_is_admin_logged_in()) {
  echo '<em><small>' . elgg_echo('izap_autotags:not_allowed') . '</small></em>';
}?>
<script language="javascript" type="text/javascript">
  $(document).ready(function(){
    $('#<?php echo $default_tag ?>').autocomplete(<?php echo $tag_string;?>,
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


<meta charset="utf-8">
	<script>
	$(function() {
		var availableTags =<?php echo $tag_string?> ;
		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}

		$( "#<?php echo $default_tag_id ?>" )
			// don't navigate away from the field on tab when selecting an item
			.bind( "keydown", function( event ) {
				if ( event.keyCode === $.ui.keyCode.TAB &&
						$( this ).data( "autocomplete" ).menu.active ) {
					event.preventDefault();
				}
			})
      
			.autocomplete({
				minLength: 0,
				source: function( request, response ) {  
					// delegate back to autocomplete, but extract the last term
					response( $.ui.autocomplete.filter(
						availableTags, extractLast( request.term ) ) );
				},
				focus: function() {
					// prevent value inserted on focus
					return false;
				},
 
				select: function( event, ui ) {
					var terms = split( this.value );
					// remove the current input
					terms.pop();
					// add the selected item
          formatted_input=ui.item.value.split( '(');
					terms.push( formatted_input[0] );
					// add placeholder to get the comma-and-space at the end
					terms.push( "" );
					this.value = terms.join( ", " );
					return false;
				}
			});
	});
	</script>

