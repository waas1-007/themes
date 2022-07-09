<header id="apus-header" class="apus-header header-v3 hidden-sm hidden-xs" role="banner">
    <div class="<?php echo (famita_get_config('keep_header') ? 'main-sticky-header-wrapper' : ''); ?>">
        <div class="<?php echo (famita_get_config('keep_header') ? 'main-sticky-header' : ''); ?>">
            <div class="inner-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="table-visiable">
                            <div class="col-md-2">
                                <div class="header-left clearfix">
                                    <div class="pull-left">
                                        <?php if( is_user_logged_in() ){ ?>
                                            <div class="top-wrapper-menu">
                                                <a class="drop-dow icon-menu-top"><i class="icon_menu"></i></a>
                                                <?php if ( has_nav_menu( 'top-menu' ) ) {
                                                        $args = array(
                                                            'theme_location' => 'top-menu',
                                                            'container_class' => 'inner-top-menu',
                                                            'menu_class' => 'nav navbar-nav topmenu-menu',
                                                            'fallback_cb' => '',
                                                            'menu_id' => '',
                                                            'walker' => new Famita_Nav_Menu()
                                                        );
                                                        wp_nav_menu($args);
                                                    }
                                                ?>
                                            </div>
                                        <?php } else { ?>
                                            <div class="top-wrapper-menu">
                                                <a class="drop-dow icon-menu-top"><i class="icon_menu"></i></a>
                                                <?php get_template_part( 'template-parts/login' ); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php if ( famita_get_config('show_searchform') ){ ?>
                                        <div class="pull-left">
                                            <a class="btn-search-top"><i class="icon_search"></i></a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php if ( has_nav_menu( 'primary' ) ) : ?>
                            <div class="col-md-8">
                                <div class="logo-in-theme text-center">
                                    <?php get_template_part( 'template-parts/logo/logo' ); ?>
                                </div>
                                <?php if ( has_nav_menu( 'primary' ) ) : ?>
                                    <div class="main-menu">
                                        <nav data-duration="400" class="hidden-xs hidden-sm apus-megamenu slide animate navbar p-static" role="navigation">
                                        <?php   $args = array(
                                                'theme_location' => 'primary',
                                                'container_class' => 'collapse navbar-collapse no-padding',
                                                'menu_class' => 'nav navbar-nav megamenu',
                                                'fallback_cb' => '',
                                                'menu_id' => 'primary-menu',
                                                'walker' => new Famita_Nav_Menu()
                                            );
                                            wp_nav_menu($args);
                                        ?>
                                        </nav>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                            <div class="col-md-2">
                                <div class="header-right clearfix">
                                <?php if ( defined('FAMITA_WOOCOMMERCE_ACTIVED') && famita_get_config('show_cartbtn') && !famita_get_config( 'enable_shop_catalog' ) ): ?>
                                    <div class="pull-right">
                                        <?php get_template_part( 'woocommerce/cart/mini-cart-button' ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ( class_exists( 'YITH_WCWL' ) ){
                                    $wishlist_url = YITH_WCWL()->get_wishlist_url();
                                ?>
                                    <div class="pull-right">
                                        <a class="wishlist-icon" href="<?php echo esc_url($wishlist_url);?>" title="<?php esc_attr_e( 'View Your Wishlist', 'famita' ); ?>"><i class="icon_heart_alt"></i>
                                            <?php if ( function_exists('yith_wcwl_count_products') ) { ?>
                                                <span class="count"><?php echo yith_wcwl_count_products(); ?></span>
                                            <?php } ?>
                                        </a>
                                    </div>
                                <?php } elseif( famita_is_woosw_activated() ) {
                                    $woosw_page_id = WPCleverWoosw::get_page_id();
                                ?>
                                    <div class="pull-right">
                                        <a class="wishlist-icon" href="<?php echo esc_url(get_permalink($woosw_page_id));?>">
                                            <i class="icon_heart_alt"></i>
                                            <span class="count woosw-custom-menu-item">0</span>
                                        </a>
                                    </div>
                                <?php } ?>
                                
                            </div>
                        </div>   
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <div class="over-dark"></div>
</header>
<?php if ( famita_get_config('show_searchform') ): ?>
    <div class="search-header">
         <?php get_template_part( 'template-parts/productsearchform-nocategory' ); ?>
    </div>
<?php endif; ?>