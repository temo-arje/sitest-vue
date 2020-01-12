<?php get_header(); ?>
    <div id="app">
        <!--<li >-->
        <!--    <router-link class="menu__links-item" to="/blog">ბლოგი</router-link>-->
        <!--</li>-->


        <div id='cssmenu'>
            <?php wp_nav_menu(array(
                'theme_location' => 'header-menu',
                'menu_id' => 'cssmenu',
                'menu_class' => 'მენიუს ul ტეგის კლასის მინიჭება',
                'container' => false,
                'walker' => new  Walkernav()
            ));
            ?>
        </div>
        <sitestudio></sitestudio>
    </div>

<?php get_footer(); ?>