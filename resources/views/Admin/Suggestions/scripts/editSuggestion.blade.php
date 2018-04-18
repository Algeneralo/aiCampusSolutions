<script>
    $('.approve_btn').on('click', function () {
        let tr = $(this).parent().parent().find('tr').eq(2);
        $(this).attr('disabled', true);
        suggestionReplay_ajax(tr, '/approveEditSuggestion');
    });
    $('.reject_btn').on('click', function () {
        let tr = $(this).parent().parent().find('tr').eq(2);
        swal({
            title: "Are you sure?",
            text: "Once Reject, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    suggestionReplay_ajax(tr, '/rejectEditSuggestion');
                } else {

                }
            });

    });
    $('tr textarea:not(:last)').on('focus click keyup', function () {
        let textarea = $(this);
        if (textarea.val().replace(/\s+/g, ' ').trim() === '') {
            textarea.siblings().css('display', 'inline-block');
        } else {
            textarea.siblings().css('display', 'none');
        }
    });

    function suggestionReplay_ajax(tr, url) {
        let student_email = tr.find('td').eq(0).text().trim();
        let suggestion_id = tr.find('td').eq(1).text().trim();
        let question_id = tr.find('td').eq(2).text().trim();
        let subject = tr.find('td').eq(3).find('textarea').val().replace(/\s+/g, ' ').trim();
        let info = tr.find('td').eq(4).find('textarea').val().replace(/\s+/g, ' ').trim();
        let link1 = tr.find('td').eq(5).find('textarea').val().replace(/\s+/g, ' ').trim();
        let link2 = tr.find('td').eq(6).find('textarea').val().replace(/\s+/g, ' ').trim();
        $.ajax({
            url: url,
            method: 'post',
            data: {
                '_token': '{{csrf_token()}}',
                'student_email': student_email,
                'suggestion_id': suggestion_id,
                'question_id': question_id,
                'subject': subject,
                'info': info,
                'link1': link1,
                'link2': link2,
            }, success: function (data) {
                if (data['status'] == 204) {
                    removeRow(tr);
                } else {
                    swal("Oops!", "Something went wrong on the page!", "error");
                }

            }, error: function (data) {
                // console.log(data.responseJSON);
                swal("Error!", "Internal server error!", "error");
            }
        })
    }

    function removeRow(tr) {
        let suggestionDiv = tr.parent().parent().parent().parent();
        suggestionDiv.slideUp(1000, function () {
            $(this).remove();
        });
        let suggestionDivsCount = suggestionDiv.parent().find('div.panel').length;
        if (suggestionDivsCount === 1) {
            suggestionDiv.parent().parent().slideUp(1000, function () {
                $(this).remove();
            });
            let divParent = suggestionDiv.parent().parent().parent();
            if (divParent.find('>div.panel').length - 1 === 0) {
                divParent.append(
                    '<div class="panel panel-warning">' +
                    '   <div class="panel-heading text-center">' +
                    '       You have finished all suggestions in this page!' +
                    '   </div>' +
                    '</div>'
                );
                $('.page-content').css('height', '498').fadeIn();
            }
        }
    }

    $('.panel-heading:not(:first)').on('click', function () {
        $(this).siblings().slideToggle('slow');
    })
</script>