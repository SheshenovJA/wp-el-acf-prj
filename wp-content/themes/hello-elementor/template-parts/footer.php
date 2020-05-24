<?php
/**
 * The template for displaying footer.
 *
 * @package WebxElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$footer_logo = get_field('footer_image', 'option');

$fb_url = get_field('fb_url', 'option');

$isnt_ulr= get_field('inst_url', 'option');;

?>
<footer class="footer">
    <div class="container">
        <div class="footer__main">
            <?php if ( has_nav_menu( 'menu-main' ) ) : ?>

                <?php wp_nav_menu( array(
                    'container'       => 'div',
                    'container_class' => 'footer__nav',
                    'echo'            => true,
                    'fallback_cb'     => false,
                    'items_wrap'      => '<ul id="%1$s" class="footer__nav__list">%3$s</ul>',
                    'item_spacing'    => 'preserve',
                    'depth'           => 0,
                    'theme_location'  => 'footer-menu',
                    'add_li_class'  => 'footer__nav__item',
                    'add_a_class'   => 'footer__nav__link'

                ) ); ?>

            <?php endif;?>

            <div class="footer__soc">
                <img src="<?php echo $footer_logo['url'] ?>" alt="" class="footer__soc__logo">
                <div class="footer__soc__list">
                    <a href="<?php echo $fb_url?>" class="footer__soc__link">
                        <svg viewBox="0 0 24 24">
                            <path d="M17,2V2H17V6H15C14.31,6 14,6.81 14,7.5V10H14L17,10V14H14V22H10V14H7V10H10V6A4,4 0 0,1 14,2H17Z"></path>
                        </svg>
                    </a>
                    <a href="<?php echo $isnt_ulr?>" class="footer__soc__link">
                        <svg viewBox="0 0 24 24">
                            <path d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z"></path>
                        </svg>
                    </a>

                </div>
            </div>
        </div>
    </div>
</footer>

<div class="copy">
    <div class="container">
        <div class="copy__main">
            <p class="copy__text">Copyright @ <?php echo date("Y"); ?> <a href="">Easyspace.com</a> All rights.</p>
            <ul>
                <li><a href="">Press</a> |</li>
                <li><a href="">Terms and Conditions</a> |</li>
                <li><a href="">Legal and Privacy</a></li>
            </ul>
        </div>
    </div>
</div>
