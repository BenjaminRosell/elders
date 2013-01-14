/*******************************************
********************************************
SLIDERS
********************************************
********************************************/
jQuery.noConflict()(function($){
    $(document).ready(function() {
		/*News slider*/
		var rsi = $(".news_slides_container").royalSlider({
            arrowsNav: false,
            slidesSpacing: 20,
            imageScaleMode: 'none',
            fadeinLoadedSlide: true,
            imageAlignCenter:false,
            sliderTouch: true,
            keyboardNavEnabled: true
        }).data('royalSlider'); 
		$('#slider_news_next').click(function() {rsi.next();});
		$('#slider_news_prev').click(function() {rsi.prev();});
		/*Home slider*/
		$("#slider_home").royalSlider({
            arrowsNav: true,
            loop: false,
            keyboardNavEnabled: true,
            fadeinLoadedSlide: false,
            controlsInside: true,
            imageScaleMode: 'fill',
            arrowsNavAutoHide: false,
            autoScaleSlider: true, 
            autoScaleSliderWidth: 960,     
            autoScaleSliderHeight: 350,
            controlNavigation: 'bullets',
            thumbsFitInViewport: false,
            navigateByClick: true,
            startSlideId: 0,
            autoPlay: false,
            transitionType:'move',
            globalCaption: true
        });  
		/*Last project carousel*/
		$("#slider_latest").royalSlider({
            arrowsNav: true,
            slidesSpacing: 0,
            imageScaleMode: 'none',
            fadeinLoadedSlide: false,
            imageAlignCenter:false,
            sliderTouch: true,
            arrowsNavAutoHide: true,
            keyboardNavEnabled: true
        });
    });    
});
/*******************************************
********************************************
BOOTSTRAP
********************************************
********************************************/
jQuery.noConflict()(function($){
    $(document).ready(function() {
		/**********************************************
        *Tooltip
        **********************************************/
		$('[data-tip]').each( function() {$(this).tooltip({ placement: $(this).data('tip') }); });
        /**********************************************
        *Tabs
        **********************************************/
        /*each tab needs to be activated individually here*/
        $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
        })
        /**********************************************
        *Accordions (FAQ)
        **********************************************/
        $(".collapse").collapse();
        /**********************************************
        Dropdown
        **********************************************/
        $('.dropdown-toggle').dropdown();
        /**********************************************
        Alerts
        **********************************************/
        $(".alert").alert('closed');
	});
});
/*******************************************
********************************************
MENU + MENU RESPONSIVE
********************************************
********************************************/
jQuery.noConflict()(function($){
    $(document).ready(function() {
        $('ul.sf-menu').superfish();
        
        $(".navmenu a").each(function() 
        {   
            if (this.href == window.location.href)
            {
                $(this).addClass("active");
            }
        });
		/*Responsive menu*/
		/*Menu displaying only on the phone*/
        // Create the dropdown base
        $("<select />").appendTo("nav.navmenu");

        // Create default option "Go to..."
        $("<option />", {
            "selected": "selected",
            "value"   : "",
            "text"    : "Go to..."
        }).appendTo("nav.navmenu select");

        // Populate dropdown with menu items
        $("nav.navmenu a").each(function() {
                var el = $(this);
                var menu_url = el.attr("href");
                var menu_text = el.text();

                if (el.parents("li").length == 2) { menu_text = '- ' + menu_text; }
                if (el.parents("li").length > 3) { menu_text = "-- " + menu_text; }
                $("<option />", {"value": menu_url, "text": menu_text}).appendTo("nav.navmenu select")
        });
        // To make dropdown actually work
        // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
        $("nav.navmenu select").change(function() {
            window.location = $(this).find("option:selected").val();
        });
    });    
});
/*******************************************
********************************************
TWITTER FEED
********************************************
********************************************/
jQuery.noConflict()(function($){
    $(document).ready(function() {
         $(".widget_twitter").tweet({
            username: "2F_webd", //Your twitter name goes here
            join_text: "auto",
            avatar_size: null,
            count: 2,
            auto_join_text_default: null, 
            auto_join_text_ed: null,
            auto_join_text_ing: null,
            auto_join_text_reply: null,
            auto_join_text_url: null,
            loading_text: "loading tweets..."
		});
    });    
});
/*******************************************
********************************************
OVER PROJECTS
********************************************
********************************************/
jQuery.noConflict()(function($){
    $(document).ready(function() {
        $('.latest_block, .portfolio_item_image').mouseenter(function() {
            $(this).children('.latest_over').fadeIn(300).addClass("light_background");
            $('.latest_over_picture').fadeIn(300);
            $('.latest_over_link').fadeIn(300);

        }).mouseleave(function() {
            $(this).children('.latest_over, .portfolio_item_image').fadeOut(10).removeClass("light_background");
            $('.latest_over_picture').fadeOut(10);
            $('.latest_over_link').fadeOut(10);
        });
    });    
});
/*******************************************
********************************************
FILTERING
********************************************
********************************************/
jQuery.noConflict()(function($){
    $(document).ready(function() {
        // cache container
		var $container = $('#portfolio_container');
		// initialize isotope
		$container.isotope({
			// options...
			itemSelector : '.portfolio_item',
			layoutMode : 'fitRows'
		});
		// filter items when filter link is clicked
		$('.filters a').click(function(){
			var selector = $(this).attr('data-filter');
			$container.isotope({ filter: selector });
			return false;
		});
    });    
});
/*******************************************
********************************************
SCROLL
********************************************
********************************************/
jQuery.noConflict()(function($){
    $(document).ready(function() {
        $('.scroll_top_a').click(function() {
            $('body,html').animate({
                scrollTop:0
            },1200);
		});
    });    
});
/*******************************************
********************************************
PRETTYPHOTO
********************************************
********************************************/
jQuery.noConflict()(function($){
    $(document).ready(function() {
        $("a[data-rel^='prettyPhoto']").prettyPhoto({
                animation_speed: 'normal', /* fast/slow/normal */
                slideshow: 5000, /* false OR interval time in ms */
                autoplay_slideshow: false, /* true/false */
                opacity: 0.80, /* Value between 0 and 1 */
                show_title: true, /* true/false */
                allow_resize: true, /* Resize the photos bigger than viewport. true/false */
                default_width: 500,
                hook: 'data-rel',
                default_height: 344,
                counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
                theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
                horizontal_padding: 20, /* The padding on each side of the picture */
                hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
                wmode: 'opaque', /* Set the flash wmode attribute */
                autoplay: true, /* Automatically start videos: True/False */
                modal: false, /* If set to true, only the close button will close the window */
                deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
                overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
                keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
                changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
                callback: function(){}, /* Called when prettyPhoto is closed */
                ie6_fallback: true,
                markup: '<div class="pp_pic_holder"> \
                                        <div class="ppt">&nbsp;</div> \
                                        <div class="pp_top"> \
                                                <div class="pp_left"></div> \
                                                <div class="pp_middle"></div> \
                                                <div class="pp_right"></div> \
                                        </div> \
                                        <div class="pp_content_container"> \
                                                <div class="pp_left"> \
                                                <div class="pp_right"> \
                                                        <div class="pp_content"> \
                                                                <div class="pp_loaderIcon"></div> \
                                                                <div class="pp_fade"> \
                                                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                                                        <div class="pp_hoverContainer"> \
                                                                                <a class="pp_next" href="#">next</a> \
                                                                                <a class="pp_previous" href="#">previous</a> \
                                                                        </div> \
                                                                        <div id="pp_full_res"></div> \
                                                                        <div class="pp_details"> \
                                                                                <div class="pp_nav"> \
                                                                                        <a href="#" class="pp_arrow_previous">Previous</a> \
                                                                                        <p class="currentTextHolder">0/0</p> \
                                                                                        <a href="#" class="pp_arrow_next">Next</a> \
                                                                                </div> \
                                                                                <p class="pp_description"></p> \
                                                                                {pp_social} \
                                                                                <a class="pp_close" href="#">Close</a> \
                                                                        </div> \
                                                                </div> \
                                                        </div> \
                                                </div> \
                                                </div> \
                                        </div> \
                                        <div class="pp_bottom"> \
                                                <div class="pp_left"></div> \
                                                <div class="pp_middle"></div> \
                                                <div class="pp_right"></div> \
                                        </div> \
                                </div> \
                                <div class="pp_overlay"></div>',
                gallery_markup: '<div class="pp_gallery"> \
                                                        <a href="#" class="pp_arrow_previous">Previous</a> \
                                                        <div> \
                                                                <ul> \
                                                                        {gallery} \
                                                                </ul> \
                                                        </div> \
                                                        <a href="#" class="pp_arrow_next">Next</a> \
                                                </div>',
                image_markup: '<img id="fullResImage" src="{path}" />',
                flash_markup: '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>',
                quicktime_markup: '<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>',
                iframe_markup: '<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',
                inline_markup: '<div class="pp_inline">{content}</div>',
                custom_markup: '',
                social_tools: 'false'
        });
    });    
}); 