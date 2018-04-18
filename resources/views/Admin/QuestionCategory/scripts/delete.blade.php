<script>
    $('.delete_btn').on('click', function () {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    ajax_delete($(this));
                } else {

                }
            });
    });

    function ajax_delete(element) {
        let id = element.parent().parent().find('td').eq(0).text();
        $.ajax({
            url: '/questionCategory/' + id,
            dataType: "json",
            type: "DELETE",
            data: {
                '_token': '{{csrf_token()}}',
            },
            success: function (data) {
                if (data['status'] === 204) {
                    check_table_elements(element);
                    element.parent().parent().remove();
                    swal("Poof! Your Data has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Oops!", "Something went wrong on the page!", "error");
                }
            },
            error: function () {
                swal("Oops!", "Something went wrong on the page!", "error");
            }
        });
    }

    function check_table_elements(element) {
        let tr_length = element.parent().parent().parent().find('tr').length;
        if (tr_length - 1 === 0) {
            element.parent().parent().parent().append("                    <tr>\n" +
                "                        <td class=\"text-center\" colspan=\"4\">No data found</td>\n" +
                "                    </tr>")
        }

    }
</script>