// script for adding images in apply property
$(document).ready(function(){
    var thumbcount = 1;
    $(".upload-area").click(function(){
        $('#upload-input').trigger('click');
    });

    $('#upload-input').change(event => {
        if(event.target.files){
            let filesAmount = event.target.files.length;
            $('.upload-img').html("");

            for(let i = 0; i < filesAmount; i++){
                let reader = new FileReader();
                reader.onload = function(event){
                    
                    let html = `
                        <div class = "uploaded-img">
                            <img src = "${event.target.result}"><br>
                            <input type="text" name="image_title[]" class="imageTitle" placeholder="Label this image">
                            <label>Set this image as thumbnail</label>
                            <input type="radio" name="thumbnail" value="${thumbcount++}" class="thumbnail">
                            <button type = "button" class = "remove-btn">
                                <i class = "fas fa-times"></i>
                            </button>
                        </div>
                    `;
                    $(".upload-img").append(html);
                }
                reader.readAsDataURL(event.target.files[i]);
            }

            $('.upload-info-value').text(filesAmount);
            $('.upload-img').css('padding', "20px");
        }
    });

    $(window).click(function(event){    
        if($(event.target).hasClass('remove-btn')){
            $(event.target).parent().remove();
        } else if($(event.target).parent().hasClass('remove-btn')){
            $(event.target).parent().parent().remove();
        }
    })
});
