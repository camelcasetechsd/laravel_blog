$(document).ready(function () {
    /**
     * no empty comments
     */
    if ($('#active-comment').val() === '') {
        $('#submit-comment').prop('disabled', true);
    }
    // on change
    $('#active-comment').keyup(function () {
        if ($('#active-comment').val() === '') {
            $('#submit-comment').prop('disabled', true);
        } else {
            $('#submit-comment').prop('disabled', false);
        }
    });


    /**
     * comment event
     */
    $('#submit-comment').click(function (event) {
        event.preventDefault();
        $commentVal = $('#active-comment').val();
        $.ajax({
            method: 'POST',
            url: '/comment',
            data: {
                comment: $commentVal,
                post: $('#postId').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function ($data) {
            // comment block
            $commentDiv = '<div class="media"> <a class="pull-left" href="#"> <img class="media-object" src="' + $data.img + '" alt=""> </a> <div class="media-body"> <h4 class="media-heading">' + $data.name + '<small>' + $data.date + '</small> </h4> ' + $commentVal + ' </div> </div>'
            $('#comments-hock').after($commentDiv);
            $('#active-comment').val('');
        });
    });


    /**
     * real-time comment editing 
     */
    $('#comment-editor').click(function(){
        
    });



});

function editComment$id 
{
    
}
