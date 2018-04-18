<script>
    jQuery.extend(jQuery.validator.messages, {
        extension: "Please upload only excel files!"

    });
    $("#uploadSpreadsheet_form").validate({
        submitHandler: function (form) {
            $("#uploadSpreadsheet_form input[type='submit']").attr('disabled', true);
            form.submitHandler()
        },
        rules: {
            college: {
                required: true
            },
            QuestionCategory: {
                required: true
            },
            spreadsheet: {
                required: true,
                extension: "xls|csv|xlsx"
            }
        }
    });
</script>