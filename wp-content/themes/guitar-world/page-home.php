<?php
/*
Template Name: Главная
*/

get_header();
?>


<!-- section-top -->
<?php
$top_img_id       = carbon_get_post_meta( get_the_ID(), 'top_image' );
$img_src          = wp_get_attachment_url( $top_img_id, 'full' );
$top_img_src_webp = conver_to_webp_src( $img_src );
?>
<section class="section-top lazy" data-src="<?php echo $img_src ?>"
         data-src-replace-webp="<?php echo $top_img_src_webp ?>">
    <div class="container section-top__container">
        <p class="section-top__info"><?php echo carbon_get_post_meta( get_the_ID(), 'top_info' ); ?></p>
        <h1 class="section-top__title"><?php echo carbon_get_post_meta( get_the_ID(), 'top_title' ); ?></h1>
        <div class="section-top__btn">
            <button class="btn" type="button"
                    data-scroll-to="<?php echo carbon_get_post_meta( get_the_ID(), 'top_button_scroll' ); ?>">
                <?php echo carbon_get_post_meta( get_the_ID(), 'top_button_text' ); ?>
            </button>
        </div>
    </div>
</section>
<!-- /.section-top -->

<!-- section-catalog -->
<section id="section-catalog" class="section section-catalog js-section-catalog js-catalog">
    <div class="container">
        <header class="section__header">
            <h2 class="page-title page-title--accent">
                <?php echo carbon_get_post_meta( get_the_ID(), 'catalog_title' ); ?>
            </h2>
            <nav class="catalog-nav">
                <?php
                    $catalog_nav = carbon_get_post_meta(14, 'catalog_nav');
                    $catalog_nav_ids = [];
                    foreach ($catalog_nav as $item){
                        $catalog_nav_ids[] = $item['id'];
                    }
                    $catalog_nav_items = get_terms([
                            'include' => $catalog_nav_ids,
                    ]);
                ?>
                <ul class="catalog-nav__wrapper">
                    <li class="catalog-nav__item">
                        <button class="catalog-nav__btn is-active" type="button" data-filter="all">все</button>
                    </li>
                    <?php
                        if($catalog_nav_items):
                            foreach ($catalog_nav_items as $item):
                    ?>

                    <li class="catalog-nav__item">
                        <button class="catalog-nav__btn" type="button" data-filter="<?php echo  $item->slug?>"><?php echo  $item->name?></button>
                    </li>
                   <?php
                   endforeach;
                   endif;
                   ?>
                </ul>
            </nav>
        </header>

        <div class="catalog">
            <?php
            $catalog_products     = carbon_get_post_meta( 14, 'catalog_products' );
            $catalog_products_ids = wp_list_pluck( $catalog_products, 'id' );

            $catalog_products_query_args = [
                'post_type' => 'products',
                'post_in'   => $catalog_products_ids,
            ];
            $catalog_products_query      = new WP_Query( $catalog_products_query_args );

            if ( $catalog_products_query->have_posts() ):
                while ( $catalog_products_query->have_posts() ):
                    $catalog_products_query->the_post();

                    ?>

                    <?php echo get_template_part('product-content')?>

                <?php
                endwhile;
            else :
             esc_html_e( 'Нет постов по вашим критериям' );
            wp_reset_postdata();
            endif;
            ?>
        </div>
        <div class="section-catalog__footer">
            <a class="link" href="<?php echo get_home_url( null, 'products/' ) ?>">
                Перейти в каталог
            </a>
        </div>
    </div>
</section>
<!-- /.section-catalog -->

<!-- section-about -->
<section class="section section-about">
    <picture>
        <?php
        $rew_img_id       = carbon_get_post_meta( 14, 'about_image' );
        $img_src          = wp_get_attachment_url( $rew_img_id, 'full' );
        $top_img_src_webp = conver_to_webp_src( $img_src );
        ?>

        <img class="section-about__img lazy"
             src="<? echo $img_src ?>"
             data-src="<? echo $img_src ?>" alt="">
    </picture>
    <div class="container section-about__container">
        <div class="section-about__content">
            <h2 class="page-title section-about__title">
                <?php echo carbon_get_post_meta( 14, 'catalog_title' ); ?>
            </h2>
            <div class="section-about__text">
                <?php
                echo carbon_get_post_meta( 14, 'about_text' );
                ?>
            </div>
        </div>
</section>
<!-- /.section-about -->
<!-- section-contacts -->
<section id="section-contacts" class="section section-contacts">
    <div class="container section-contacts__container">
        <div class="section-contacts__img lazy"
             data-src=""
             data-src-replace-webp="">

        </div>
        <header class="section__header">
            <h2 class="page-title sectoin-contacts__title">
                <?php echo carbon_get_post_meta( get_the_ID(), 'contacts_title' ); ?>
            </h2>
        </header>
        <div class="contacts">
            <div class="contacts__start">
                <div class="contacts__map" id="ymap"
                     data-coordinates="<?= $GLOBALS['guitar']['address-coordination'] ?>"></div>
            </div>
            <div class="contacts__end">
                <? if ( $GLOBALS['guitar']['address'] ) : ?>
                    <div class="contacts__item">
                        <h3 class="contacts__title">Адрес</h3>
                        <p class="contacts__text"><?= $GLOBALS['guitar']['address'] ?></p>
                    </div>
                <? endif; ?>
                <div class="contacts__item">
                    <h3 class="contacts__title">Телефон</h3>
                    <p class="contacts__text">
                        <a class="contacts__phone" href="tel:<?= $GLOBALS['guitar']['phone-digit'] ?>">
                            <?= $GLOBALS['guitar']['phone'] ?>
                        </a>
                    </p>
                </div>
                <div class="contacts__item">
                    <h3 class="contacts__title">Социальные сети</h3>
                    <ul class="socials">
                        <?php
                        if ( $GLOBALS['guitar']['vk'] ) :
                            ?>
                            <li class="socials__item">
                                <a href="<?= $GLOBALS['guitar']['vk'] ?>" class="socials__link" target="_blank">
                                    <svg class="socials__icon socials__icon--vk" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 112.2 112.2" width="35" height="35">
                                        <g>
                                            <circle cx="56.1" cy="56.1" r="56.1"/>
                                            <path class="socials__logo"
                                                  d="M54,80.7h4.4a3.33,3.33,0,0,0,2-.9,3.37,3.37,0,0,0,.6-1.9s-.1-5.9,2.7-6.8,6.2,5.7,9.9,8.2c2.8,1.9,4.9,1.5,4.9,1.5l9.8-.1s5.1-.3,2.7-4.4c-.2-.3-1.4-3-7.3-8.5-6.2-5.7-5.3-4.8,2.1-14.7,4.5-6,6.3-9.7,5.8-11.3s-3.9-1.1-3.9-1.1l-11.1.1a2.32,2.32,0,0,0-1.4.3,3.58,3.58,0,0,0-1,1.2A60,60,0,0,1,70,50.9c-4.9,8.4-6.9,8.8-7.7,8.3-1.9-1.2-1.4-4.9-1.4-7.5,0-8.1,1.2-11.5-2.4-12.4a17.68,17.68,0,0,0-5.2-.5c-4,0-7.3,0-9.2.9-1.3.6-2.2,2-1.6,2.1a5.05,5.05,0,0,1,3.3,1.6c1.1,1.5,1.1,5,1.1,5s.7,9.6-1.5,10.7c-1.5.8-3.5-.8-7.9-8.4a67.05,67.05,0,0,1-4-8.2,2.82,2.82,0,0,0-.9-1.2,5.13,5.13,0,0,0-1.7-.7l-10.5.1s-1.6,0-2.2.7,0,1.9,0,1.9,8.2,19.3,17.6,29c8.5,9,18.2,8.4,18.2,8.4Z"/>
                                        </g>
                                    </svg>
                                </a>
                            </li>

                        <?php
                        endif;
                        if ( $GLOBALS['guitar']['fc'] ):
                            ?>
                            <li class="socials__item">
                                <a href="<?= $GLOBALS['guitar']['fc'] ?>" class="socials__link" target="_blank">
                                    <svg class="socials__icon socials__icon--fb" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 112.2 112.2" width="35" height="35">
                                        <g>
                                            <circle cx="56.1" cy="56.1" r="56.1"/>
                                            <path class="socials__logo"
                                                  d="M70.2,58.3h-10V95H45V58.3H37.8V45.4H45V37.1c0-6,2.8-15.3,15.3-15.3H71.5V34.3H63.3c-1.3,0-3.2.7-3.2,3.5v7.6H71.4Z"/>
                                        </g>
                                    </svg>
                                </a>
                            </li>
                        <?php
                        endif;
                        if ( $GLOBALS['guitar']['instagram'] ):
                            ?>
                            <li class="socials__item">
                                <a href="<?= $GLOBALS['guitar']['instagram'] ?>" class="socials__link" target="_blank">
                                    <svg class="socials__icon socials__icon--inst" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 512 512" width="35" height="35">
                                        <g>
                                            <path d="M332.3,136.2H179.7a44.21,44.21,0,0,0-44.2,44.2V333a44.21,44.21,0,0,0,44.2,44.2H332.3A44.21,44.21,0,0,0,376.5,333V180.4A44.21,44.21,0,0,0,332.3,136.2ZM256,336a79.3,79.3,0,1,1,79.3-79.3A79.42,79.42,0,0,1,256,336Zm81.9-142.2A18.8,18.8,0,1,1,356.7,175,18.78,18.78,0,0,1,337.9,193.8Z"/>
                                            <path d="M256,210.9a45.8,45.8,0,1,0,45.8,45.8A45.86,45.86,0,0,0,256,210.9Z"/>
                                            <path d="M256,0C114.6,0,0,114.6,0,256S114.6,512,256,512,512,397.4,512,256,397.4,0,256,0ZM410,333a77.78,77.78,0,0,1-77.7,77.7H179.7A77.78,77.78,0,0,1,102,333V180.4a77.84,77.84,0,0,1,77.7-77.7H332.3A77.84,77.84,0,0,1,410,180.4Z"/>
                                        </g>
                                    </svg>
                                </a>
                            </li>
                        <? endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.section-contacts -->

<script>

</script>

<?php get_footer(); ?>
