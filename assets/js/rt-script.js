jQuery(function ($) {
    
    const default_settings = {
        arrows: false,
        speed: 500,
        centerPadding: "0px",
        dots: true,
        slidesToShow: 1,
        infinite: false
    }

    // replace "on" with true
    const plugin_settings = Object.entries(slider_settings).reduce((acc, [key, value]) => {
        acc[key] = value === "on" ? true : value;
        return acc;
    }, {});
    // console.log(plugin_settings);

    const settings  = {...default_settings,...plugin_settings};
    
    $('.rt-slider').slick(settings);
    // console.log(settings);
})