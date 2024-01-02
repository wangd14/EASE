$(document).ready(function () {
    // sidebar
    $('.icon').click(function() {
        hideOtherPage();
        if($(this).hasClass('pageview_icon')) {
            //each pageview has a class of 'pageview0', starting with pageview following by its button's id
            $('.pageview' + $(this).attr('id')).removeClass('hidden');
            $(this).addClass('active');
        } else {
            $($(this).attr('class').split(' ')[0]).removeClass('hidden');
            $(this).addClass('active');
        }  
    });

    $('.expand_icon').hover(function() {
        if(!($('menubody').hasClass('expand_sidebar'))) {
            $('.expand_icon_svg').addClass('rotate_-90');
        }
    }, function() {
        if(!($('menubody').hasClass('expand_sidebar'))) {
            $('.expand_icon_svg').removeClass('rotate_-90');
        }
    });

    $('.expand_icon').click(function() {
        if($('menubody').hasClass('expand_sidebar')) {
            $('menubody').removeClass('expand_sidebar');
            $('.expand_icon').removeClass('translateX_128');
            $('.expand_icon').removeClass('active');
            $('.expand_icon_svg').removeClass('rotate_-90');
            $('.icon').removeClass('expand_all_icon');
        } else {
            $('menubody').addClass('expand_sidebar');
            $('.expand_icon').addClass('translateX_128');
            $('.expand_icon').addClass('active');
            $('.expand_icon_svg').addClass('rotate_-90');
            $('.icon').addClass('expand_all_icon');
        }
    });

    // upload page
    $('#file').change(function() {
        var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '');
        $('#file-name').text(filename + ' - ' + (this.files[0].size/1024).toFixed(3) + 'kB');
        
        var preview = document.querySelector('#file-preview');
        var file    = document.querySelector('input[type=file]').files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result + '#toolbar=0';
            $('#file-preview').css('border','solid 2px #6C63FF');
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    });

    $('#class_name, #exam_name').focus(function () {
        $(this).css('border-bottom','2px solid #6C63FF');
    }).blur(function() {
        if($(this).val() == '') {
            $(this).css('border-bottom','2px solid #2f2e43');
        }
    });

    $('#exam_description').focus(function () {
        if($(this).text() == "Write a description for this exam." || $(this).val() == "Write a description for this exam.") {
            $(this).text("").val("");
        }
        $(this).css('border','1px solid #6C63FF')
        .css('color','#2f2e43');
    }).blur(function () {
        if($(this).val() == '') {
            $(this).text("Write a description for this exam.")
            .val("Write a description for this exam.")
            .css('border','1px solid #2f2e43')
            .css('color','#a0a0a0');;
        }
    });
});

/**
 * hideOtherPage
 * If a page is not hidden, hide it.
 */
function hideOtherPage () {
    $('.icon').removeClass('active');
    $('.page').each(function() {
        if(!($(this).hasClass('hidden'))) {
            $(this).addClass('hidden');
        }
    });
}