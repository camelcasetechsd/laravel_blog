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
            $commentDiv = '<div class="media row"> <div class="col-lg-12"> <h4 class="media-heading"> ' + $data.name + '<small> ' + $data.date + '</small> &nbsp;&nbsp;&nbsp; <a href="javascript:void(0)" id="comment-editor"><span class="glyphicon glyphicon-pencil"></span></a></h4> </div> <div class="col-lg-1"> <a class="pull-left" href="#"> <img class="media-object" width="50px" height="50px" src="' + $data.avatar + '" alt=""> </a> </div> <div class="col-lg-8"> <div class="media-body"> <p id="comment" class="comment-string"> ' + $commentVal + '</p> </div> </div> </div> <hr>'
            $('#comments-hock').after($commentDiv);
            $('#active-comment').val('');
            $('#submit-comment').prop('disabled', true);
        });
    });


//    /**
//     * real-time comment editing 
//     */
//    $('#comment-editor').click(function () {
//
//    });


    $(document).on('click','#comment-editor',function(){
        $commentP = $(this).find('.comment-string');
        console.log($commentP);
    });


});

function editComment($id)
{

}
