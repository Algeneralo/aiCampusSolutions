<!-- Modal -->
<div id="add_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add College</h4>
            </div>
            <form id="add_modal_form" action="{{route('colleges.store')}}" method="post">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="add_modal_college">Name</label>
                            <input id="add_add_modal_college" name="add_modal_college" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn green">
                </div>
            </form>
        </div>

    </div>
</div>