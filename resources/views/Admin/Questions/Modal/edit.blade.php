<!-- Modal -->
<div id="edit_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit question</h4>
            </div>
            <form id="edit_modal_form">
                <div class="modal-body">
                    <div class="row">
                        <input id="edit_modal_id" type="hidden">
                        <div class="form-group col-md-6">
                            <label for="edit_modal_subject">Subject</label>
                            <input id="edit_modal_subject" name="edit_modal_subject" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edit_modal_info">Info</label>
                            <textarea id="edit_modal_info" name="edit_modal_info" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edit_modal_link1">Link1</label>
                            <textarea id="edit_modal_link1" name="edit_modal_link1" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edit_modal_link2">Link2</label>
                            <textarea id="edit_modal_link2" name="edit_modal_link2" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edit_modal_link3">Link3</label>
                            <textarea id="edit_modal_link3" name="edit_modal_link3" class="form-control" value=""></textarea>
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