<header id="apus-header" class="apus-header header-v8 hidden-sm hidden-xs" role="banner">
    <div class="<?php echo (famita_get_config('keep_header') ? 'main-sticky-header-wrapper' : ''); ?>">
        <div class="<?php echo (famita_get_config('keep_header') ? 'main-sticky-header' : ''); ?>">
            <div class="header-bottom container p-relative">
                <div class="row">
                    <div class="table-visiable">
                        <div class="col-lg-3 col-md-3">
                            <div class="logo-in-theme ">
                                <?php get_template_part( 'template-parts/logo/logo' ); ?>
                            </div>
                        </div>
                        <?php if ( has_nav_menu( 'primary' ) ) : ?>
                        <div class="col-lg-9 col-md-9 p-static">
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