<?php

/**
 *  Plugin Name: blocchi
 *  Text Domain: blocchi
*/


use Carbon_Fields\Block;
use Carbon_Fields\Field;

defined( 'ABSPATH') || exit;

/* blocchi01 */

function blocchi_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}

    add_action( 'after_setup_theme', 'blocchi_load' );

       function blocchi_attach_theme_options() {
        Block::make( 'Blocchi' ) 
            ->add_fields( array(
                Field::make( 'text', 'heading', __( 'Block Heading' ) ),
                Field::make( 'image', 'image', __( 'Block Image' ) ),
                Field::make( 'rich_text', 'content', __( 'Block Content' ) ),
            ) )

            ->set_render_callback( function ( $block ) {

                ob_start();
                ?>
    
            <a href="<?php the_permalink();?>">

                <div class="block row  align-items-end">

                    <div class="text__article col-7">

                        <div class="block__heading">
                            <h3><?php echo esc_html( $block['heading'] ); ?></h3>
                        </div><!-- /.block__heading -->

                        <div class="block__content">
                            <?php echo apply_filters( 'the_content', $block['content'] ); ?>
                        </div><!-- /.block__content -->

                    </div>

                    <div class="image__article col-4 offset-1">
            
                        <div class="block__image">
                            <?php echo wp_get_attachment_image( $block['image'], 'medium' ); ?>
                        </div><!-- /.block__image -->

                    </div>

                </div><!-- /.block -->    
                
            </a>


            <?php

                return ob_get_flush();
            } );

        Block::make( 'Blocchi02' ) 
        ->add_fields( array(
            Field::make( 'image', 'foto', __( 'Block Foto' ) ),
            Field::make( 'text', 'role', __( 'Block Role' ) ),
            Field::make( 'text', 'name', __( 'Block Name' ) ),
            Field::make( 'text', 'power', __( 'Block Power' ) ),
            Field::make( 'rich text', 'content', __( 'Block Content' ) ),
        ) )

        ->set_render_callback( function ( $block ) {

            ob_start();
            ?>

            <div class="block row">

                <div class="person col-11 offset-1">

                    <div class="block col-4">

                        <div class="block__foto">
                            <?php echo wp_get_attachment_image( $block['foto'], 'medium' ); ?>
                        </div><!-- /.block__image -->

                        <div class="block">
                            <h6 class="block__role"><?php echo esc_html( $block['role'] ); ?></h6>
                            <h4 class="block__name"><?php echo esc_html( $block['name'] ); ?></h4>
                        </div><!-- /.block__subheading -->

                    </div>

                    <div class="textooo col-7">

                        <div class="block__power">
                            <h3><?php echo esc_html( $block['power'] ); ?></h3>
                        </div><!-- /.block__heading -->

                        <div class="block__content">
                            <?php echo apply_filters( 'the_content', $block['content'] ); ?>
                        </div><!-- /.block__content -->

                    </div>

                </div>

            </div><!-- /.block -->    

        <?php

            return ob_get_flush();
        } );
    }


add_action( 'carbon_fields_register_fields', 'blocchi_attach_theme_options' );


