$(document).ready(function(){
    function openModal(imageSrc, caption) {
        var modal = $('#imageModal');
        var modalImg = modal.find('.modal-content img'); 
        var captionText = modal.find('.modal-content div'); 
    
        modal.css('display', 'block');
        modalImg.attr('src', 'resources/images/properties/' + imageSrc);
        captionText.html(caption);
    
        var span = modal.find('.close');
    
        span.on('click', function() {
            modal.css('display', 'none');
        });
    }
    
    $('.modal-trigger').on('click', function(event){
        event.stopPropagation();
        var imageSrc = $(this).attr('data-image-src');
        var caption = $(this).attr('alt');
        openModal(imageSrc, caption);
    });
    
    $(document).on('click', function(event) {
        if ($(event.target).hasClass('modal')) {
            $('.modal').css('display', 'none');
        }
    });
});