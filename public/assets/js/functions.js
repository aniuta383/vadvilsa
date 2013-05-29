bkLib.onDomLoaded(function() {
    new nicEditor().panelInstance('about-vadvilsa');
});
$(function(){
    setInterval(function() {
        $('.slider :nth-child(1)').next().show().end().fadeOut(2500).appendTo('.slider');
    } , 4000);
});
$(function(){
    $('.cats').on('mouseenter', function(){
        $(this).find('.subcats').addClass("visible");
    });
    $('.cats').on('mouseleave', function(){
        $(this).find('.subcats').removeClass("visible");
    });
});
$(function () {
    $('.top-links a').each(function () {
        $(this).mouseenter(function () {
            $(this).fadeTo('slow', 0.5);
        });
        $(this).mouseleave(function () {
            $(this).fadeTo('fast', 1);
        });
    });
});