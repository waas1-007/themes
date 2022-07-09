
<div class="apus-offcanvas dark-menu-sidebar hidden-sm hidden-xs"> 
    <div class="offcanvas-top">
        <div class="logo-in-theme">
            <?php get_template_part( 'template-parts/logo/logo' ); ?>
        </div>
        <div class="clearfix">
            <div class="header-right pull-left">
                <?php if ( class_exists( 'YITH_WCWL' ) ):
                    $wishlist_url = YITH_WCWL()->get_wishlist_url();
                ?>
                    <div class="pull-right">
                        <a class="wishlist-icon" href="<?php echo esc_url($wishlist_url);?>" title="<?php esc_attr_e( 'View Your Wishlist', 'famita' ); ?>"><i class="icon_heart_alt"></i>
                            <?php if ( function_exists('yith_wcwl_count_products') ) { ?>
                                <span class="count"><?php echo yith_wcwl_count_products(); ?></span>
                            <?php } ?>
                        </a>
                    </div>
                <?php endif; ?>
                
                <?php if ( famita_get_config('show_searchform') ){ ?>
                    <div class="pull-right">
                        <a class="btn-search-top"><i class="icon_search"></i></a>
                    </div>
                <?php } ?>
                <div class="pull-right">
                    <?php if( is_user_logged_in() ){ ?>
                        <div class="top-wrapper-menu">
                            <a class="drop-dow" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><i class="icon_lock_alt"></i></a>
                        </div>
                    <?php } else { ?>
                        <div class="top-wrapper-menu">
                            <a class="drop-dow" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><i class="icon_lock_alt"></i></a>
                        </div>
                    <?php } ?>
                </div>
                <?php if ( defined('FAMITA_WOOCOMMERCE_ACTIVED') && famita_get_config('show_cartbtn') && !famita_get_config( 'enable_shop_catalog' ) ): ?>
                    <div class="pull-right">
                        <?php get_template_part( 'woocommerce/cart/mini-cart-button-header-left' ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="offcanvas-middle">
        <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <div class="apus-offcanvas-body">
                <nav class="navbar navbar-offcanvas navbar-static" role="navigation">
                    <?php
                        $args = array(
                            'theme_location' => 'primary',
                            'container_class' => 'navbar-collapse navbar-offcanvas-collapse',
                            'menu_class' => 'nav navbar-nav main-mobile-menu',
                            'fallback_cb' => '',
                            'menu_id' => '',
                            'walker' => new Famita_Mobile_Menu()
                        );
                        wp_nav_menu($args);
                    ?>
                </nav>
            </div>
        <?php endif; ?>
    </div>
    <div class="offcanvas-bottom">
        <?php if ( is_active_sidebar( 'sidebar-topbar-left' ) ) { ?>
            <div class="sidebar-topbar-left">
                <?php dynamic_sidebar( 'sidebar-topbar-left' ); ?>
            </div>
        <?php } ?>
         <?php
            $social_links = famita_get_config('header_social_links_link');
            $social_icons = famita_get_config('header_social_links_icon');
            if ( !empty($social_links) ) {
                ?>
                <ul class="social-top">
                    <?php foreach ($social_links as $key => $value) { ?>
                        <li class="social-item">
                            <a href="<?php echo esc_url($value); ?>">
                                <i class="<?php echo esc_attr($social_icons[$key]); ?>"></i>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <?php
            }
        ?>
    </div>
</div>
<div class="over-dark"></div>
