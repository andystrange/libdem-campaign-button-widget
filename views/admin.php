<!-- This file is used to markup the administration form of the widget. -->


		 <p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $display_title ); ?>" />
		</p>
	    </p>

		<p>
			<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e('Style'); ?></label>
			<select name="<?php echo $this->get_field_name( 'style' ); ?>" id="<?php echo $this->get_field_id( 'style' ); ?>" class="widefat">
				<?php
	
				$options = $this->get_display_styles();
				foreach ($options as $option) {
					echo '<option value="' . $option . '" id="' . $option . '"';
					if ( $option == $display_style ) {

						echo ' selected="selected" ';
					}
					echo '>' . $option . '</option>';
				}
				?>
			</select>
		</p>

