<?php
/**
 * Define custom fields for widgets
 * 
 * @package VMag
 */
function vmag_widgets_show_widget_field( $instance = '', $widget_field = '', $athm_field_value = '' ) {
    
    extract( $widget_field );

    switch ( $vmag_widgets_field_type ) {

    	// Standard text field
        case 'text' :
        ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $vmag_widgets_name ) ); ?>"><?php echo esc_html( $vmag_widgets_title ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $vmag_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $vmag_widgets_name ) ); ?>" type="text" value="<?php echo esc_html( $athm_field_value ); ?>" />

                <?php if ( isset( $vmag_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $vmag_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Standard url field
        case 'url' :
        ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $vmag_widgets_name ) ); ?>"><?php echo esc_html( $vmag_widgets_title ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $vmag_widgets_name ) ); ?>" name="<?php echo esc_html( $instance->get_field_name( $vmag_widgets_name ) ); ?>" type="text" value="<?php echo esc_html( $athm_field_value ); ?>" />

                <?php if ( isset( $vmag_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $vmag_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Textarea field
        case 'textarea' :
        ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $vmag_widgets_name ) ); ?>"><?php echo esc_html( $vmag_widgets_title ); ?>:</label>
                <textarea class="widefat" rows="<?php echo esc_attr($vmag_widgets_row); ?>" id="<?php echo esc_attr( $instance->get_field_id( $vmag_widgets_name ) ); ?>" name="<?php echo esc_html( $instance->get_field_name( $vmag_widgets_name ) ); ?>"><?php echo esc_html( $athm_field_value ); ?></textarea>
            </p>
        <?php
            break;

        // Checkbox field
        case 'checkbox' :
        ?>
            <p>
                <input id="<?php echo esc_attr( $instance->get_field_id( $vmag_widgets_name ) ); ?>" name="<?php echo esc_html( $instance->get_field_name( $vmag_widgets_name ) ); ?>" type="checkbox" value="1" <?php checked('1', $athm_field_value); ?>/>
                <label for="<?php echo esc_attr( $instance->get_field_id( $vmag_widgets_name ) ); ?>"><?php echo esc_html( $vmag_widgets_title ); ?></label>

                <?php if ( isset( $vmag_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $vmag_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Radio fields
        case 'radio' :
        	if( empty( $athm_field_value ) ) {
        		$athm_field_value = $vmag_widgets_default;
        	}
        ?>
            <p>
                <?php
                echo esc_html( $vmag_widgets_title );
                echo '<br />';
                foreach ( $vmag_widgets_field_options as $athm_option_name => $athm_option_title ) {
                    ?>
                    <input id="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>" name="<?php echo esc_html( $instance->get_field_name( $vmag_widgets_name ) ); ?>" type="radio" value="<?php echo esc_attr($athm_option_name); ?>" <?php checked( $athm_option_name, $athm_field_value ); ?> />
                    <label for="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>"><?php echo esc_html($athm_option_title); ?></label>
                    <br />
                <?php } ?>

                <?php if ( isset( $vmag_widgets_description ) ) { ?>
                    <small><?php echo esc_html( $vmag_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Select field
        case 'select' :
            if( empty( $athm_field_value ) ) {
                $athm_field_value = $vmag_widgets_default;
            }
        ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $vmag_widgets_name ) ); ?>"><?php echo esc_html( $vmag_widgets_title ); ?>:</label>
                <select name="<?php echo esc_attr( $instance->get_field_name( $vmag_widgets_name ) ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $vmag_widgets_name ) ); ?>" class="widefat">
                    <?php foreach ( $vmag_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
                        <option value="<?php echo esc_attr($athm_option_name); ?>" id="<?php echo esc_attr( $instance->get_field_id($athm_option_name ) ); ?>" <?php selected( $athm_option_name, $athm_field_value ); ?>><?php echo esc_html( $athm_option_title ); ?></option>
                    <?php } ?>
                </select>

                <?php if ( isset( $vmag_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $vmag_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        case 'number' :
        	if( empty( $athm_field_value ) ) {
        		$athm_field_value = $vmag_widgets_default;
        	}
        ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $vmag_widgets_name ) ); ?>"><?php echo esc_html( $vmag_widgets_title ); ?>:</label><br />
                <input name="<?php echo esc_html( $instance->get_field_name( $vmag_widgets_name ) ); ?>" type="number" step="1" min="1" id="<?php echo esc_attr( $instance->get_field_id( $vmag_widgets_name ) ); ?>" value="<?php echo esc_html( $athm_field_value ); ?>" class="small-text" />

                <?php if ( isset( $vmag_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $vmag_widgets_description ); ?></small>
                <?php } ?>
            </p>
       	<?php
            break;

        case 'section_header':
        ?>
        	<span class="section-header"><?php echo esc_html( $vmag_widgets_title ); ?></span>
        <?php
        	break;

        case 'widget_layout_image':
        ?>
            <div class="layout-image-wrapper">
                <span class="image-title"><?php echo esc_html( $vmag_widgets_title ); ?></span>
                <img src="<?php echo esc_url( $vmag_widgets_layout_img ); ?>" title="<?php esc_attr_e( 'Widget Layout', 'vmag' ); ?>" />
            </div>
        <?php
            break;

        case 'upload' :

            $id = $instance->get_field_id($vmag_widgets_name);
            $class = '';
            $int = '';
            $value = $athm_field_value;
            $name = $instance->get_field_name($vmag_widgets_name);


            if ($value) {
                $class = ' has-file';
            }
            ?>
            <div class="sub-option widget-upload">
            <label for="<?php echo esc_attr($instance->get_field_id($vmag_widgets_name)); ?>"><?php esc_html($vmag_widgets_title); ?></label><br/>
            <input id="<?php echo esc_attr($id); ?>" class="upload <?php echo esc_attr($class); ?>" type="text" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_url($value); ?>" placeholder="<?php esc_attr_e('No file chosen', 'vmag'); ?>" />
            <?php
            if (function_exists('wp_enqueue_media')) {
            ?>
                <input id="upload-<?php echo esc_attr($id); ?>" class="ap-upload-button button" type="button" value="<?php esc_attr_e('Upload', 'vmag'); ?>" />
            <?php
            } else {
            ?>
                <p><i><?php esc_html_e('Upgrade your version of WordPress for full media support.', 'vmag'); ?></i></p>
            <?php
            }
            ?>
            <div class="screenshot team-thumb" id="<?php echo esc_attr($id); ?>-image"><br/>
            <?php
            if ($value != '') {
                $attachment_id = attachment_url_to_postid($value);

                $image_array = wp_get_attachment_image_src($attachment_id, 'medium');
                $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value);
                if ($image) {
                    ?>
                    <img width="100%" height="" src="<?php echo esc_url($image_array[0]); ?>" alt="" /><a class="remove-image remove-screenshot"><?php esc_html_e( 'Remove', 'vmag' ); ?></a>
                    <?php
                } else {
                    $parts = explode("/", $value);
                    for ($i = 0; $i < sizeof($parts); ++$i) {
                        $title = $parts[$i];
                    }

                    // Standard generic output if it's not an image.
                    $title = esc_html__('View File', 'vmag');
                    ?>
                    <div class="no-image"><span class="file_link"><a href="<?php echo esc_url($value) ?>" target="_blank" rel="external"><?php esc_html($title); ?></a></span></div>
                    <?php
                }
            }
            ?>
            </div></div><br/>
            <?php
            break;

        //Multi checkboxes
        case 'multicheckboxes':
            if( empty( $athm_field_value ) ) {
                $athm_field_value = $vmag_widgets_default;
            }
            if( isset( $vmag_widgets_title ) ) {
            ?>
                <label><?php echo esc_html( $vmag_widgets_title ); ?>:</label>
            <?php
            }
            foreach ( $vmag_widgets_field_options as $athm_option_name => $athm_option_title) {

                if( isset( $athm_field_value[$athm_option_name] ) ) {
                    $athm_field_value[$athm_option_name] = 1;
                }else{
                    $athm_field_value[$athm_option_name] = 0;
                }
                
            ?>
                <p>
                    <input id="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) );?>" name="<?php echo esc_attr( $instance->get_field_name( $vmag_widgets_name ).'['.$athm_option_name.']' ); ?>" type="checkbox" value="1" <?php checked( '1', $athm_field_value[$athm_option_name] ); ?>/>
                    <label for="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) );?>"><?php echo esc_html($athm_option_title); ?></label>
                </p>
            <?php
                }
                if ( isset( $vmag_widgets_description ) ) {
            ?>
                    <small><em><?php echo esc_html( $vmag_widgets_description ); ?></em></small>
            <?php
                }
        break;
    }
}

function vmag_widgets_updated_field_value( $widget_field, $new_field_value ) {

    extract( $widget_field );

    // Allow only integers in number fields
    if ( $vmag_widgets_field_type == 'number') {
        return vmag_sanitize_number( $new_field_value );

        // Allow some tags in textareas
    } elseif ( $vmag_widgets_field_type == 'textarea' ) {
        // Check if field array specified allowed tags
        if ( !isset( $vmag_widgets_allowed_tags ) ) {
            // If not, fallback to default tags
            $vmag_widgets_allowed_tags = '<p><strong><em><a>';
        }
        return strip_tags( $new_field_value, $vmag_widgets_allowed_tags );

        // No allowed tags for all other fields
    } elseif ( $vmag_widgets_field_type == 'url' ) {
        return esc_url( $new_field_value );
    } elseif ( $vmag_widgets_field_type == 'multicheckboxes' ) {
        return $new_field_value;
    } else {
        return strip_tags( $new_field_value );
    }
}