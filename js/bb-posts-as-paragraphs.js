/* JavaScript code related to posts as paragraphs */

jQuery(document).ready(function() {

    jQuery(".dropdown-menu-posts-as-paragraphs .menu-items a").click(function() {

        var $post_heading = jQuery(this).html();
        var $menu_trigger = jQuery(".dropdown-menu-posts-as-paragraphs .trigger");
        var $menu_items = jQuery(".dropdown-menu-posts-as-paragraphs .menu-items");

        $menu_trigger.html( $post_heading );
        $menu_items.hide()

    });

    /**
     * Make the side navigation on small screen stick
     */
    jQuery(window).scroll(function(e){

        var $el = jQuery('.dropdown-menu-posts-as-paragraphs');

        if ( $el.length > 0 ) {

            var isPositionFixed = ($el.css('position') == 'fixed');

            distance = $el.offset().top,
                $window = jQuery(window);

            if ( $window.scrollTop() >= distance && !isPositionFixed ) {
                jQuery('.dropdown-menu-posts-as-paragraphs').addClass("dropdown-menu-posts-as-paragraphs--floating");
            }
            if ( jQuery(this).scrollTop() < 200 && isPositionFixed )
            {
                jQuery('.dropdown-menu-posts-as-paragraphs').removeClass("dropdown-menu-posts-as-paragraphs--floating");
            }

        }

    });

    /**
     * When click on the link going to anchor scroll 50 pixels before the anchor
     */
    jQuery(window).on("hashchange", function () {
        window.scrollTo(window.scrollX, window.scrollY - 30);
    });

    // Toggle the side navigation dropdown
    jQuery(".dropdown-menu-posts-as-paragraphs .trigger").click(function() {

        jQuery(".dropdown-menu-posts-as-paragraphs .menu-items").toggle();

        if ( jQuery(this).hasClass( "collapsed" ) ) {
            jQuery(this).removeClass( "collapsed" ).addClass( "uncollapsed" );
        } else {
            jQuery(this).removeClass( "uncollapsed" ).addClass( "collapsed" );
        }

    });

    /**
     *  Smooth scrolling to anchor
     */
    jQuery("#row-posts-as-paragraphs aside a").on('click', function(event) {

        if (this.hash !== "") {

            event.preventDefault();
            var hash = this.hash;

            jQuery('html, body').animate({
                scrollTop: jQuery(hash).offset().top - 30
            }, 800, function () {
                window.location.hash = hash;
            });
        }

    });

});

/* END: JavaScript code related to paragraphs */