<script>
    $('.edit_btn').on('click', function (e) {
        td = $(this).parent().parent().find('td');
        let id = td.eq(0).text();
        let college_id = td.eq(1).text();
        let question = td.eq(3).text();
        $('#edit_modal_id').val(id);
        $('#edit_modal_question').val(question);
        $('#edit_modal_college').val(college_id);
        console.log(college_id);
        $('#edit_modal').modal('toggle');
    });
    $("#edit_modal_form").validate({
        submitHandler: function (form) {
            $("#edit_modal_form input[type='submit']").attr('disabled', true);
            ajax_edit();
        },
        rules: {
            edit_modal_question: {
                required: true
            }, edit_modal_college: {
                required: true
            }
        }
    });

    function ajax_edit() {
        $.ajax({
            url: '/questionCategory/' + $('#edit_modal_id').val(),
            dataType: "json",
            type: "PUT",
            data: {
                '_token': '{{csrf_token()}}',
                'question': $('#edit_modal_question').val(),
                'college': $('#edit_modal_college').val(),
            },
            success: function (data) {
                if (data['status'] === 204) {
                    let option_val = $('#edit_modal_college').val();
                    td.eq(3).text($('#edit_modal_question').val());
                    td.eq(4).text($('#edit_modal_college option[value="' + option_val + '"]').text());
                    $("#edit_modal_form input[type='submit']").attr('disabled', false);
                    $('#edit_modal').modal('toggle');
                    swal("Your Data has been updated!", {
                        icon: "success",
                    });
                } else {
                    $("#edit_modal_form input[type='submit']").attr('disabled', false);
                    $('#edit_modal').modal('toggle');
                    swal("Oops!", "Something went wrong on the page!", "error");
                }

            },
            error: function (data) {
                $("#edit_modal_form input[type='submit']").attr('disabled', false);
                $('#edit_modal').modal('toggle');
                swal("Oops!", "Something went wrong on the page!", "error");
            }
        });
    }
</script>