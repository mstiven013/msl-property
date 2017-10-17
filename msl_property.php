<?php 

/*
Plugin Name: Msl Propiedades
Plugin URI: http://www.websuniversal.com/mslproperty
Description: Este plugin se usa para gestionar cualquier tipo de propiedades.
Version: 1.0
Author: Webs Univesal
Author URI: http://www.websuniversal.com
License: GPL2
Text Domain: mslproperty
*/

add_action( 'add_meta_boxes', 'msl_metabox_def' );
add_action( 'save_post', 'msl_save_fields' );
add_action('admin_enqueue_scripts', 'msl_admin_styles');
add_action('login_enqueue_scripts', 'msl_admin_styles');
add_action('init', 'msl_taxonomies', 1);
add_action('wp_head','add_jquery_ui');


if(!function_exists(msl_admin_styles)) {
	function msl_admin_styles() {
		wp_enqueue_style('my-admin-theme', plugins_url('templates/css/admin.css', __FILE__));
	}
}

if(!function_exists(add_jquery_ui)) {

	function add_jquery_ui() {
		echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
		echo '<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>';
		echo '<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">';
		echo '<link rel="stylesheet" href="'.plugins_url('templates/css/msl_styles.css', __FILE__).'">';
	}

}

if(!function_exists(msl_metabox_def)) {

    function msl_metabox_def() {

        add_meta_box('msl_metabox','Datos del inmueble','msl_metabox','post');
        add_meta_box('msl_advanced_metabox','Información avanzada','msl_advanced_metabox','post');

    }

}

if(!function_exists(msl_data_upload)){

    function msl_data_upload($name) {

        $values = get_post_custom($post->ID);

        $field = esc_attr($values[$name][0]);

        return $field;

    }

}

if(!function_exists(msl_metabox)) {

    function msl_metabox() { ?>

        <div class="row row-3">
            <div class="column">
                <fieldset>
                    <label class="title_field" for="msl_id">ID de la propiedad</label>
                    <input type="text" name="msl_id" id="msl_id" value="<?php echo msl_data_upload('msl_id'); ?>">
                </fieldset>
            </div>
            <div class="column">
                <fieldset>
                    <label class="title_field" for="msl_municipio">Municipio</label>
                    <input type="text" name="msl_municipio" id="msl_municipio" value="<?php echo msl_data_upload('msl_municipio'); ?>">
                </fieldset>
            </div>
            <div class="column">
                <fieldset>
                    <label class="title_field" for="msl_sector">Sector</label>
                    <input type="text" name="msl_sector" id="msl_sector" value="<?php echo msl_data_upload('msl_sector'); ?>">
                </fieldset>
            </div>
        </div>

        <div class="row row-2">
            <div class="column">
                <fieldset>
                    <label class="title_field" for="msl_precio">Precio</label>
                    <input type="number" name="msl_precio" id="msl_precio" value="<?php echo msl_data_upload('msl_precio'); ?>">
                </fieldset>
            </div>
            <div class="column">
                <fieldset>
                    <label class="title_field" for="msl_area">&Aacute;rea en m2</label>
                    <input type="text" name="msl_area" id="msl_area" value="<?php echo msl_data_upload('msl_area'); ?>">
                </fieldset>
            </div>
        </div>

    <?php }

}

if(!function_exists(msl_advanced_metabox)) {

    function msl_advanced_metabox() {

        ?>

        <div class="row row-4">
            <div class="column">
                <fieldset>
                    <label class="title_field">Nuevo o usado:</label>
                    <input type="radio" name="msl_estado" id="msl_estado_n" value="nuevo" <?php (msl_data_upload('msl_estado') == "nuevo") ? print 'checked="checked"' : '' ?>> <label for="msl_estado_n">Nuevo</label>
                    <input type="radio" name="msl_estado" id="msl_estado_u" value="usado" <?php (msl_data_upload('msl_estado') == "usado") ? print 'checked="checked"' : '' ?>> <label for="msl_estado_u">Usado</label>
                </fieldset>
            </div>
            <div class="column">
                <fieldset>
                    <label class="title_field">Unidad cerrada o abierta:</label>
                    <input type="radio" name="msl_unidad" id="msl_unidad_c" value="cerrada" <?php (msl_data_upload('msl_unidad') == "cerrada") ? print 'checked="checked"' : '' ?>> <label for="msl_unidad_c">Cerrada</label>
                    <input type="radio" name="msl_unidad" id="msl_unidad_a" value="abierta" <?php (msl_data_upload('msl_unidad') == "abierta") ? print 'checked="checked"' : '' ?>> <label for="msl_unidad_a">Abierta</label>
                </fieldset>
            </div>
            <div class="column">
                <fieldset>
                    <label class="title_field">Parqueadero:</label>
                    <input type="radio" name="msl_parqueadero" id="msl_parqueadero_si" value="si" <?php (msl_data_upload('msl_parqueadero') == "si") ? print 'checked="checked"' : '' ?>> <label for="msl_parqueadero_si">Si</label>
                    <input type="radio" name="msl_parqueadero" id="msl_parqueadero_no" value="no" <?php (msl_data_upload('msl_parqueadero') == "no") ? print 'checked="checked"' : '' ?>> <label for="msl_parqueadero_no">No</label>
                </fieldset>
            </div>
            <div class="column">
                <fieldset>
                    <label class="title_field">Cuarto util:</label>
                    <input type="radio" name="msl_cuarto_util" id="msl_cuarto_util_si" value="si" <?php (msl_data_upload('msl_cuarto_util') == "si") ? print 'checked="checked"' : '' ?>> <label for="msl_cuarto_util_si">Si</label>
                    <input type="radio" name="msl_cuarto_util" id="msl_cuarto_util_no" value="no" <?php (msl_data_upload('msl_cuarto_util') == "no") ? print 'checked="checked"' : '' ?>> <label for="msl_cuarto_util_no">No</label>
                </fieldset>
            </div>
        </div>

        <div class="row row-4">
            <div class="column">
                <fieldset>
                    <label class="title_field" for="msl_habitaciones">Número de habitaciones</label>
                    <input type="number" name="msl_habitaciones" id="msl_habitaciones" value="<?php echo msl_data_upload('msl_habitaciones'); ?>">
                </fieldset>
            </div>
        </div>

    <?php }

}

if(!function_exists(msl_save_fields)) {

    function msl_save_fields($post_id) {

        // Validaciones para guardar los datos.
        if ( wp_is_post_autosave( $post_id ) ) {
            return;
        }

        if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {

            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }

        } else {

            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }

        }


        //Guardamos los datos básicos
        $msl_id = sanitize_text_field($_POST['msl_id']);
        $msl_m = sanitize_text_field($_POST['msl_municipio']);
        $msl_s = sanitize_text_field($_POST['msl_sector']);
        $msl_p = sanitize_text_field($_POST['msl_precio']);
        $msl_ar = sanitize_text_field($_POST['msl_area']);

        // Guardamos en la base de daots.
        update_post_meta($post_id, 'msl_id', $msl_id);
        update_post_meta($post_id, 'msl_municipio', $msl_m);
        update_post_meta($post_id, 'msl_sector', $msl_s);
        update_post_meta($post_id, 'msl_precio', $msl_p);
        update_post_meta($post_id, 'msl_area', $msl_ar);


        //Guardamos los datos avanzados
        $msl_un = isset( $_POST['msl_unidad']) ? sanitize_html_class( $_POST['msl_unidad'] ) : '';
        $msl_par = isset( $_POST['msl_parqueadero']) ? sanitize_html_class( $_POST['msl_parqueadero'] ) : '';
        $msl_cu = isset( $_POST['msl_cuarto_util']) ? sanitize_html_class( $_POST['msl_cuarto_util'] ) : '';
        $msl_es = isset( $_POST['msl_estado']) ? sanitize_html_class( $_POST['msl_estado'] ) : '';
        $msl_ha = sanitize_text_field($_POST['msl_habitaciones']);

 
        // Guardamos en la base de daots.
        update_post_meta($post_id,'msl_unidad',$msl_un);
        update_post_meta($post_id,'msl_parqueadero',$msl_par);
        update_post_meta($post_id,'msl_cuarto_util',$msl_cu);
        update_post_meta($post_id,'msl_estado',$msl_es);
        update_post_meta($post_id,'msl_habitaciones',$msl_ha);

    }

}

if(!function_exists(msl_taxonomies)) {

    function msl_taxonomies() {

        //Creamos la seccion de tipo de disponibilidad
        $labels_d = array(
            'name'              => _x( 'Tipo de disponibilidad', 'Tipo de disponibilidad', 'mslproperty' ),
            'singular_name'     => _x( 'Tipo de disponibilidad', 'Tipo de disponibilidad', 'mslproperty' ),
            'search_items'      => __( 'Buscar tipos disponibilidad', 'mslproperty' ),
            'all_items'         => __( 'Todos los tipos de disponibilidad', 'mslproperty' ),
            'edit_item'         => __( 'Editar tipo de disponibilidad', 'mslproperty' ),
            'update_item'       => __( 'Actualizar tipo de disponibilidad', 'mslproperty' ),
            'add_new_item'      => __( 'Añadir nuevo tipo de disponibilidad', 'mslproperty' ),
            'new_item_name'     => __( 'Nuevo nombre de  tipo de disponibilidad', 'mslproperty' ),
            'menu_name'         => __( 'Tipos de disponibilidad', 'mslproperty' ),
        );

        $args_d = array(
            'hierarchical'      => true,
            'labels'            => $labels_d,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'disponibilidad' ),
        );

        register_taxonomy( 'disponibilidad', array('post'), $args_d );

        //Creamos la seccion de tipo de inmueble
        $labels_i = array(
            'name'              => _x( 'Tipo de inmueble', 'Tipo de inmueble', 'mslproperty' ),
            'singular_name'     => _x( 'Tipo de inmueble', 'Tipo de inmueble', 'mslproperty' ),
            'search_items'      => __( 'Buscar tipos de inmueble', 'mslproperty' ),
            'all_items'         => __( 'Todos los tipos de inmueble', 'mslproperty' ),
            'edit_item'         => __( 'Editar tipo de inmueble', 'mslproperty' ),
            'update_item'       => __( 'Actualizar tipo de inmueble', 'mslproperty' ),
            'add_new_item'      => __( 'Añadir nuevo tipo de inmueble', 'mslproperty' ),
            'new_item_name'     => __( 'Nuevo nombre de tipo de inmueble', 'mslproperty' ),
            'menu_name'         => __( 'Tipos de inmueble', 'mslproperty' ),
        );

        $args_i = array(
            'hierarchical'      => true,
            'labels'            => $labels_i,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'inmueble' ),
        );

        register_taxonomy( 'inmueble', array('post'), $args_i);
    }
 }

 //Shortcode buscador
 if(!function_exists(msl_buscador)) {

 	function msl_buscador() {

 		$disponibilidad = get_terms('disponibilidad', array('orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false));
 		$inmueble = get_terms('inmueble', array('orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false));

 		//Buscar precios
 		global $wpdb;

 		$table = $wpdb->prefix . 'postmeta';
 		$query_p = "SELECT meta_value FROM $table WHERE meta_key='msl_precio' ORDER BY meta_value ASC ";
 		$precios = $wpdb->get_results($query_p);
 		$query_a = "SELECT meta_value FROM $table WHERE meta_key='msl_area' ORDER BY meta_value ASC ";
 		$areas = $wpdb->get_results($query_a); 		


 		foreach ($precios as $precio) {
 			if ($precio->meta_value != '') {
 				$max_price = max(array($precio->meta_value));
 			}
 		}

 		foreach ($areas as $area) {
 			if ($area->meta_value != '') {
 				$max_area = max(array($area->meta_value));
 			}
 		}

 		?>
		
			<form action="">
				<input type="text" name="s_Id" id="s_Id" placeholder="Buscar por ID...">
				
				<select name="s_Disponibilidad" id="s_Disponibilidad">
					<option value="0">Buscar por disponibilidad</option>
					<?php 

						foreach($disponibilidad as $disponible) { ?>

							<option value="<?php echo $disponible->slug; ?>"><?php echo $disponible->name ?></option>
							
					<?php } ?>
				</select>

				<input type="text" name="s_Municipio" id="s_Municipio" placeholder="Buscar por municipio...">

				<input type="text" name="s_Sector" id="s_Sector" placeholder="Buscar por sector...">

				<select name="s_Inmueble" id="s_Inmueble">
					<option value="0">Buscar por tipo de inmueble</option>					
					<?php 

						foreach ($inmueble as $tipo) { ?>

							<option value="<?php echo $tipo->slug ?>"><?php echo $tipo->name ?></option>
							
					<?php } ?>

				</select>

			  	<label for="s_Precio">Buscar por precio:</label>
				<input type="text" name="s_Precio" id="s_Precio" readonly style="border:0; color:#000; font-weight:bold;">			 
				<div id="slider-range-price"></div>

				<label for="s_Area">Buscar por área:</label>
				<input type="text" name="s_Area" id="s_Area" readonly style="border:0; color:#000; font-weight:bold;">			 
				<div id="slider-range-area"></div>
				
				<script>
					$(function() {
						$("#slider-range-price").slider({
						  range: true,
						  min: 0,
						  max: <?php echo $max_price; ?>,
						  values: [ 0, <?php echo $max_price; ?> ],
						  slide: function( event, ui ) {
						    $( "#s_Precio" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
						  }
						});
						$( "#s_Precio" ).val( "$" + $( "#slider-range-price" ).slider( "values", 0 ) +
						  " - $" + $( "#slider-range-price" ).slider( "values", 1 ) );

						$("#slider-range-area").slider({
						  range: true,
						  min: 0,
						  max: <?php echo $max_area; ?>,
						  values: [ 0, <?php echo $max_area; ?> ],
						  slide: function( event, ui ) {
						    $( "#s_Area" ).val( ui.values[ 0 ] + "m2 - " + ui.values[ 1 ] + "m2" );
						  }
						});
						$( "#s_Area" ).val( $( "#slider-range-area" ).slider( "values", 0 ) +
						  "m2 - " + $( "#slider-range-area" ).slider( "values", 1 ) + "m2" );
					});
				</script>

			</form>

 		<?php

 	}

}
add_shortcode('msl_buscador','msl_buscador');



 ?>