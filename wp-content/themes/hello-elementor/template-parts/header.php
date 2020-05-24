<?php
/**
 * The template for displaying header.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$site_name = get_bloginfo( 'name' );
$custom_logo_id = get_theme_mod( 'custom_logo' );
$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
$phone = get_field('phone_number', 'option');
$phone_icon = get_field('share_image', 'option');


?>
<header class="header">
    <div class="container">
        <div class="header__main">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo">
                <img src="<?php echo $image[0]?>" alt="<?php echo esc_html( $site_name ); ?>">
            </a>
            <?php if ( has_nav_menu( 'menu-main' ) ) : ?>

                <?php wp_nav_menu( array(
                        'container'       => 'nav',
                        'container_class' => 'nav',
                        'echo'            => true,
                        'fallback_cb'     => false,
                        'items_wrap'      => '<ul id="%1$s" class="nav__list">%3$s</ul>',
                        'item_spacing'    => 'preserve',
                        'depth'           => 0,
                        'theme_location'  => 'menu-main',
                        'add_li_class'  => 'nav__item',
                        'add_a_class'   => 'nav__link'

                ) ); ?>

            <?php endif;?>
            <ul class="header__menu">
                <li class="header__menu__item header-tell">
                    <img class="header-tell__img" src="<?php echo $phone_icon['url'] ?>" alt="">
                    <a href="" class="header__menu__link"><?php echo  $phone ?></a>
                </li>
                <li class="header__menu__item sing-up">
                    <a href="" class="header__menu__link">SIGN UP</a>
                </li>
                <li class="header__menu__item sing-in">
                    <a href="" class="header__menu__link">LOGIN</a>
                </li>
            </ul>
            <div class="hamb"></div>

        </div>
    </div>
</header>