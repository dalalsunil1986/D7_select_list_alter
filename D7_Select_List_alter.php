<?php
/*
 * Applying product category alter for Brand content type.
 * ref url: http://localhost:8080/gpp/node/add/brand
 */
function corporate_custom_form_alter(&$form, &$form_state, $form_id){
	
	if($form_id=='brand_node_form'){
      // loadjing vocabulary by name.    
	  $names = taxonomy_vocabulary_machine_name_load('corporate_product_category');
      // getting vocabulary id 
      $names_id = $names->vid;

      /*
	   generating taxonomy tree belongs to the vocabulary.
	   set $max_depth value to reach upto the specific label.
	  */
	  $res = taxonomy_get_tree($names_id, $parent = 0, $max_depth = 1, $load_entities = FALSE);
      foreach ($res as $term) {
        $t_n = $term->name;
        $t_id = $term->tid;
        $vals[$t_id] = $t_n;
      }
    // assigning option value to the  field.
	$form['field_corporate_product_category']['und']['#options'] = $vals;
}

?>