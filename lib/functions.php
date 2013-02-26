<?php
function format_phone($phone) {
	$number = '1-'.substr($phone,0,3).'-'.substr($phone,3,3).'-'.substr($phone,-4);
	return '<a href=tel:'.$number.'>'.'('.substr($phone,0,3).') '.substr($phone,3,3).'-'.substr($phone,-4).'</a>';
}
/**
 * generates an input element with the given atribute values
 * also examines session data for previously entered values with the same name
 * @param string $name
 * @param string $placeholder
 * @return html input element
 */
function input($name, $placeholder, $value=null, $class='') {
	if ($value == null && isset($_SESSION['POST'][$name])){
		$value=$_SESSION['POST'][$name];
		//remove from session data
		unset($_SESSION['POST'][$name]);
		$class='';
		if($value==''){
			$class .= ' error';
		}
	} else {
		$value='';
	}
	return "<input class=\"$class\" type=\"text\" name=\"$name\"  placeholder=\"$placeholder\" value=\"$value\" />";
}
/**
 * generates a select element with the given name attribute and option elements
 * also examines session data for a previously submitted value
 * @param string $name
 * @param array $options array of options in the form value => text
 * @return select element
 */
function dropdown($name, $options) {
	$select = "<select name=\"$name\">";
	//add option elements to select element
	foreach($options as $value => $text) {
		//if there is session data for name and its value is the same as the current array element, select it
		if(isset($_SESSION['POST'][$name]) && $_SESSION['POST'][$name]==$value){
			$selected = 'selected="selected"';
			unset($_SESSION['POST'][$name]);
		}else {
			$selected='';
		}
		$select .= "<option $selected value\"$value\">$text</option>";
	}
	$select .="</select>";
	return $select;
}
/**
 * generates radio buttons with the given name attribute and option elements
 * also examines session data for a previously submitted value
 * @param string $name
 * @param array $options array of options in the form value => text
 * @return radio buttons
 */
function radio($name, $options) {
	$radio = '';
	//add option elements to select element
	foreach($options as $value => $text) {
		//if there is session data for name and its value is the same as the current array element, select it
		if(isset($_SESSION['POST'][$name]) && $_SESSION['POST'][$name]==$value){
			$checked = 'checked="checked"';
			unset($_SESSION['POST'][$name]);
		}else {
			$checked='';
		}
		$radio .= "<label><input type=\"radio\" name=\"$name\" value=\"$value\" $checked />$text</label>";
	}
	return $radio;
}
/**
 * query the provided table for all rows, sorted by name, using the fields table_id and table_name
 * @param string $table name of DB table
 * @param string $default_value value of first option
 * 
 */
function get_options($table, $default_value=0, $default_name='Select'){
	$id_field = $table.'_id';
	$name_field=$table.'_name';
	$conn = connect();
	
	$sql = "SELECT {$table}_id, {$table}_name FROM {$table}s ORDER BY $name_field";
	$results = $conn-> query($sql);
	while(($row = $results->fetch_assoc()) !=null){
		$key=$row[$id_field];
		$value=$row[$name_field];
		$options[$key]=$value;
	}
	$conn->close();
}
?>