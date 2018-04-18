<script>
    $('.approve_btn').on('click', function () {
        let tr = $(this).parent().parent();
        let questionCategory = tr.find('td').eq(2).find('select');
        if (questionCategory.val() == null) {
            questionCategory.siblings().css('display', 'inline-block');
            questionCategory.focus();
        } else {
            $(this).attr('disabled', true);
            questionCategory.siblings().css('display', 'none');
            suggestionReplay_ajax(tr, '/approveAddSuggestion');
        }
    });
    $('.reject_btn').on('click', function () {
        let tr = $(this).parent().parent();
        swal({
            title: "Are you sure?",
            text: "Once Reject, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    suggestionReplay_ajax(tr, '/rejectAddSuggestion');
                } else {

                }
            });

    });
    $('select').on('change', function () {
        if ($(this).val() != null) {
            $(this).siblings().css('display', 'none')
        } else {
            $(this).siblings().css('display', 'none')
        }
    });

    function suggestionReplay_ajax(tr, url) {
        let student_email = tr.find('td').eq(0).text().trim();
        let suggestion_id = tr.find('td').eq(1).text().trim();
        let parent_id = tr.find('td').eq(2).find('select').val();
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
                'parent_id': parent_id,
                'add_modal_subject': subject,
                'add_modal_info': info,
                'add_modal_link1': link1,
                'add_modal_link2': link2,
            }, success: function (data) {
                console.log(data);
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
        tr.hide(1000, function () {
            $(this).remove();
        });
        let trLength = tr.parent().find('tr').length;
        if (trLength === 1) {
            tr.parent().parent().parent().parent().slideUp(1000, function () {
                $(this).remove();
            });
            let trParent = tr.parent().parent().parent().parent().parent();
            if (trParent.find('div.panel').length - 1 === 0) {
                trParent.append(
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