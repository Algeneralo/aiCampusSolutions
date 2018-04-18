<script>
    $('[data-toggle="tooltip"]').tooltip();
    $('#suggestion_info_form').validate({
        submitHandler: function (form) {
            ('#suggestion_info_form').find('input[type="submit"]').attr('disabled', true);
            form.submit()
        },
        rules: {
            name: {
                required: true
            }, email: {
                required: true,
                email: true
            }, department: {
                required: true
            }, ext: {
                required: true
            }, 'subject[]': {
                required: true
            }, 'info[]': {
                required: true
            }, 'link1[]': {
                required: true
            }
        }, messages: {
            'subject[]': "All subject field are required",
            'info[]': "All info field are required",
            'link1[]': "All link1 field are required",
        }
    });


    $(document).on('click', '.edit_row_btn', function () {
        append_edit_row($(this).parent().parent());
    });
    $(document).on('click', '.cancelEdit_btn', function () {
        delete_edit_row($(this).parent().parent());
    });

    function append_edit_row(tr) {
        let id = tr.find('td').eq(0).text().trim();
        let parent_id = tr.find('td').eq(1).text().trim();
        let subject = tr.find('td').eq(2).find('span').text().replace(/\s+/g, ' ').trim();
        let info = tr.find('td').eq(3).text().replace(/\s+/g, ' ').trim();
        let link1 = tr.find('td').eq(4).text().replace(/\s+/g, ' ').trim();
        let link2 = tr.find('td').eq(5).text().replace(/\s+/g, ' ').trim();
        let html =
            '<tr style="display: none;border-bottom: 4px solid #DDE">' +
            '   <th>Edit</th>' +
            '   <td hidden><input hidden name="id[]" value="' + id + '"></td>' +
            '   <td hidden><input hidden name="parent_id[]" value="' + parent_id + '"></td>' +
            '   <td width="25%"><input name="subject[]" class="form-control" placeholder="Edit subject" value="' + subject + '"></td>' +
            '   <td width="30%"><textarea name="info[]" class="form-control" placeholder="Edit info" >' + info + '</textarea></td>' +
            '   <td width="14%"><textarea name="link1[]" class="form-control" placeholder="Edit link1" >' + link1 + '</textarea></td>' +
            '   <td width="14%"><textarea name="link2[]" class="form-control" placeholder="Edit link2" >' + link2 + '</textarea></td>' +
            '   <td>' +
            '       <label class="btn btn-danger active cancelEdit_btn">' +
            '           <span class="glyphicon glyphicon-remove"></span>' +
            '       </label>' +
            '   </td>' +
            '</tr>';
        tr.after(html);
        tr.next().show('slow');
        tr.find('td').eq(6).find('label').hide('slow');
    }

    function delete_edit_row(tr) {
        tr.prev().find('td').eq(6).find('label').show('slow');
        tr.fadeOut(300, function () {
            $(this).remove();
        });
    }

    ///////////////////////////////// for add new suggestion
    (function () {
        let form = $('#add_modal_form');
        form.find('input').not('input[name="_token"]').removeAttr('disabled');
        form.find('input[type="submit"]').eq(0).remove()
    }());
    $('#add_modal_form').validate({
        submitHandler: function (form) {
            $('#add_modal_form').find('input[type="submit"]').attr('disabled', true);
            form.submit()
        },
        rules: {
            name: {
                required: true
            }, email: {
                required: true,
                email: true
            }, department: {
                required: true
            }, ext: {
                required: true
            }, subject: {
                required: true
            }, info: {
                required: true
            }, link1: {
                required: true
            }
        }
    });

</script>