<header id="apus-header" class="apus-header header-v1 hidden-sm hidden-xs" role="banner">
    <div class="<?php echo (famita_get_config('keep_header') ? 'main-sticky-header-wrapper' : ''); ?>">
        <div class="<?php echo (famita_get_config('keep_header') ? 'main-sticky-header' : ''); ?>">
            <div class="header-full header-bottom container-fluid p-relative">
                    <div class="table-visiable">
                        <div class="col-lg-2 col-md-3 w-1730-15">
                            <div class="logo-in-theme ">
                                <?php get_template_part( 'template-parts/logo/logo' ); ?>
                            </div>
                        </div>
                        <?php if ( has_nav_menu( 'primary' ) ) : ?>
                        <div class="col-lg-8 col-md-6 p-static w-1730-70">
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
                        </div>
                        <?php endif; ?>
                        <div class="col-lg-2 col-md-3 w-1730-15">
                            <div class="header-right clearfix">
                                <div class="pull-right">
                                    <?php if( is_user_logged_in()){ ?>
                                        <?php if(has_nav_menu( 'top-menu' )){ ?>
                                            <div class="top-wrapper-menu">
                                                <a class="drop-dow"><i class="icon_lock_alt"></i></a>
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
                                        <?php } ?>
                                    <?php } else { ?>
                                        <div class="top-wrapper-menu">
                                            <a class="drop-dow"><i class="icon_lock_alt"></i></a>
                                            <?php get_template_part( 'template-parts/login' ); ?>
                                        </div>
                                    <?php } ?>
                                </div>
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
                                
                                <?php if ( famita_get_config('show_searchform') ){ ?>
                                    <div class="pull-right">
                                        <a class="btn-search-top"><i class="icon_search"></i></a>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>   
            </div>
        </div>
    </div>
</header>
<?php if ( famita_get_config('show_searchform') ): ?>
    <div class="search-header">
         <?php get_template_part( 'template-parts/productsearchform-nocategory' ); ?>
    </div>
<?php endif; ?>