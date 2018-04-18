<script>

    $("#add_modal_form").validate({
        submitHandler: function (form) {
            $("#add_modal_form input[type='submit']").attr('disabled', true);
            form.submitHandler()
        },
        rules: {
            add_modal_subject: {
                required: true
            }, add_modal_info: {
                required: true
            }, add_modal_link1: {
                required: true
            }
        }
    });
</script>