<script>
    $("#search_data_form").validate({
        submitHandler: function (form) {
            get_data_ajax();
        },
        rules: {
            search_keyword: {
                required: true
            }
        }
    });

    function get_data_ajax() {
        $.ajax({
            url: '{{route('ajaxSearchData')}}',
            dataType: "json",
            type: "get",
            data: {
                '_token': '{{csrf_token()}}',
                'college_id': $('#college_id').val(),
                'keyword': $('#search_keyword').val(),
            },
            beforeSend: function () {
                $('#loader_modal').modal('show');
            },
            success: function (data) {
                setTimeout(
                    function () {
                        $('#loader_modal').modal('hide');
                    }, 1000);
                append_ajax_data(data);

            },
            error: function (data) {
                $('#loader_modal').modal('hide');
                swal("Oops!", "Something went wrong on the page!", "error");
                disableItem();
                // console.log(data.responseJSON);
            }
        });
    }

    function append_ajax_data(data) {
        let search_table_selector = $('#Search_table').find('tbody');
        search_table_selector.empty();
        if (data['status'] === 200) {
            enabledItem();
            search_table_selector.append(data['data']);
        }
        else if (data['status'] === 204) {
            disableItem();
            setTimeout(
                function () {
                    swal("Oops!", "No data Found", "error");
                }, 1003);
            search_table_selector.append(
                '<tr>' +
                '   <td class="text-center" colspan="6">No data fond, Please try again</td>' +
                '</tr>'
            );
        }
        else {
            disableItem();
            setTimeout(
                function () {
                    swal("Oops!", "Something went wrong", "error");
                }, 1003);
            search_table_selector.append(
                '<tr>' +
                '   <td class="text-center" colspan="6">Something goes wrong, Please try again</td>' +
                '</tr>'
            );
        }
    }

    $("#search_keyword").autocomplete({
        autoFocus: true,
        source: function (request, response) {
            $.ajax({
                url: "/autoCompleteAjax",
                type: "get",
                dataType: 'json',
                data: {
                    'data': request,
                    'college_id': $('#college_id').val()
                },
                success: response,
                error: function (data) {
                }

            });
        }
    }, {minLength: 3});

    function enabledItem() {
        let div = $('#studentInfo');
        div.find('input').not('input[name="_token"]').removeAttr('disabled');
        div.find('input').not('input[name="_token"]').not('input[type="submit"]').val('');
        div.find('textarea').removeAttr('disabled');
        div.find('textarea').val('');
    }

    function disableItem() {
        let div = $('#studentInfo');
        div.find('input').not('input[name="_token"]').attr('disabled', true);
        div.find('input').not('input[name="_token"]').not('input[type="submit"]').val('');
        div.find('textarea').attr('disabled', true);
        div.find('textarea').val('');
    }

</script>