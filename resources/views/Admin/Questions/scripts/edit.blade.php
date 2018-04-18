<script>
    $('.edit_btn').on('click', function (e) {
        td = $(this).parent().parent().find('td');
        let id = td.eq(0).text();
        let subject = td.eq(2).text().replace(/\s+/g, ' ').trim();
        let info = td.eq(3).text().replace(/\s+/g, ' ').trim();
        let link1 = td.eq(4).text().replace(/\s+/g, ' ').trim();
        let link2 = td.eq(5).text().replace(/\s+/g, ' ').trim();
        let link3 = td.eq(6).text().replace(/\s+/g, ' ').trim();
        $('#edit_modal_id').val(id);
        $('#edit_modal_subject').val(subject);
        $('#edit_modal_info').val(info);
        $('#edit_modal_link1').val(link1);
        $('#edit_modal_link2').val(link2);
        $('#edit_modal_link3 ').val(link3);
        $('#edit_modal').modal('toggle');
    });
    $("#edit_modal_form").validate({
        submitHandler: function (form) {
            $("#edit_modal_form input[type='submit']").attr('disabled', true);
            ajax_edit();
        },
        rules: {
            edit_modal_subject: {
                required: true
            }, edit_modal_info: {
                required: true
            }, edit_modal_link1: {
                required: true
            }, edit_modal_link2: {
                required: true
            }, edit_modal_link3: {
                required: true
            },
        }
    });

    function ajax_edit() {
        $.ajax({
            url: '/questions/' + $('#edit_modal_id').val(),
            dataType: "json",
            type: "PUT",
            data: {
                '_token': '{{csrf_token()}}',
                'subject': $('#edit_modal_subject').val().replace(/\s+/g, ' ').trim(),
                'info': $('#edit_modal_info').val().replace(/\s+/g, ' ').trim(),
                'link1': $('#edit_modal_link1').val().replace(/\s+/g, ' ').trim(),
                'link2': $('#edit_modal_link2').val().replace(/\s+/g, ' ').trim(),
                'link3': $('#edit_modal_link3').val().replace(/\s+/g, ' ').trim(),
            },
            success: function (data) {
                if (data['status'] === 204) {
                    td.eq(2).text($('#edit_modal_subject').val().replace(/\s+/g, ' ').trim());
                    td.eq(3).text($('#edit_modal_info').val().replace(/\s+/g, ' ').trim());
                    td.eq(4).text($('#edit_modal_link1').val().replace(/\s+/g, ' ').trim());
                    td.eq(5).text($('#edit_modal_link2').val().replace(/\s+/g, ' ').trim());
                    td.eq(6).text($('#edit_modal_link3').val().replace(/\s+/g, ' ').trim());
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
            error: function () {
                $("#edit_modal_form input[type='submit']").attr('disabled', false);
                $('#edit_modal').modal('toggle');
                swal("Oops!", "Something went wrong on the page!", "error");
            }
        });
    }
</script>