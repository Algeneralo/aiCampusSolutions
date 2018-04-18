<script>
    $('.edit_btn').on('click', function (e) {
        td = $(this).parent().parent().find('td');
        let id = td.eq(0).text();
        let college = td.eq(2).text();
        $('#edit_modal_id').val(id);
        $('#edit_modal_college').val(college);
        $('#edit_modal').modal('toggle');
    });
    $("#edit_modal_form").validate({
        submitHandler: function (form) {
            $("#edit_modal_form input[type='submit']").attr('disabled', true);
            ajax_edeit();
        },
        rules: {
            edit_modal_college: {
                required: true
            }
        }
    });

    function ajax_edeit() {
        $.ajax({
            url: '/colleges/' + $('#edit_modal_id').val(),
            dataType: "json",
            type: "PUT",
            data: {
                '_token': '{{csrf_token()}}',
                'college': $('#edit_modal_college').val(),
            },
            success: function (data) {
                if (data['status'] === 204) {
                    td.eq(2).text($('#edit_modal_college').val());
                    $("#edit_modal_form input[type='submit']").attr('disabled', false);
                    $('#edit_modal').modal('toggle');
                    swal("Your Data has been updated!", {
                        icon: "success",
                    });
                } else {
                    console.log('tue');
                    $("#edit_modal_form input[type='submit']").attr('disabled', false);
                    $('#edit_modal').modal('toggle');
                    swal("Oops!", "Something went wrong on the page!", "error");
                }

            },
            error: function (data) {

                console.log(data.responseJSON);
                $("#edit_modal_form input[type='submit']").attr('disabled', false);
                $('#edit_modal').modal('toggle');
                swal("Oops!", "Something went wrong on the page!", "error");
            }
        });
    }
</script>